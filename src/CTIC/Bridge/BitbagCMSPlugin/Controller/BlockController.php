<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Controller;

use CTIC\Bridge\BitbagCMSPlugin\Entity\Block;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSlider;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSliderElement;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSliderInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockTranslation;
use CTIC\Bridge\BitbagCMSPlugin\Repository\BlockRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use FOS\RestBundle\View\View;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Resource\Exception\UpdateHandlingException;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class BlockController extends ResourceController
{

    /**
     * @var BlockRepository
     */
    protected $repository;

    public function indexAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::INDEX);
        $resources = $this->resourcesCollectionProvider->get($configuration, $this->repository);

        $this->eventDispatcher->dispatchMultiple(ResourceActions::INDEX, $configuration, $resources);

        $view = View::create($resources);

        if ($configuration->isHtmlRequest()) {
            $view
                ->setTemplate($configuration->getTemplate(ResourceActions::INDEX . '.html'))
                ->setTemplateVar($this->metadata->getPluralName())
                ->setData([
                    'configuration' => $configuration,
                    'metadata' => $this->metadata,
                    'resources' => $resources,
                    $this->metadata->getPluralName() => $resources,
                ])
            ;
        }

        return $this->viewHandler->handle($configuration, $view);
    }

    private function getBlockSliderErrors(BlockSliderInterface $blockSlider)
    {
        $validator = $this->get('validator');
        $blockSliderElements = $blockSlider->getElements();
        $errors = array();
        /** @var BlockSliderElement $blockSliderElement */
        foreach($blockSliderElements as $blockSliderElement)
        {
            $blockSliderElement->setOwner($blockSlider);
            $errors = $validator->validate($blockSliderElement, null, array('cticbridgebitbag'));
            if(count($errors) > 0) {
                break;
            }
        }

        return $errors;
    }

    private function prepareBlockSliderToFutureCollectionDrops(BlockSlider $blockSlider): void
    {
        $elements = $blockSlider->getElements();
        $elementToTmp = array();

        $blockSlider->tmpElements = $elementToTmp;
    }

    private function removeBlockSliderElementsFromBlockSliderDropped(BlockSlider $blockSlider, EntityManager $em, RequestConfiguration $configuration): void
    {
        $initialElements = $blockSlider->tmpElements;

        /** @var BlockSliderElement $initialElement */
        foreach($initialElements as $initialElement)
        {
            if(!$blockSlider->hasElements($initialElement))
            {
                try{
                    $em->remove($initialElement);
                    $em->flush();
                }catch (ORMException $e)
                {
                    $this->flashHelper->addErrorFlash($configuration, $e->getMessage());
                }
            }
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function searchAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $resource = $this->repository->findByNamePart($request->get('phrase', ''));

        $view = View::create($resource);

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $resource = $this->repository->findByCode($request->get('code', ''));

        $view = View::create($resource);

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $type = $request->get('type');

        $this->isGrantedOr403($configuration, ResourceActions::CREATE);
        /** @var Block $block */
        $block = $this->newResourceFactory->create($configuration, $this->factory);
        $block->setType($type);

        $form = $this->resourceFormFactory->create($configuration, $block);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            /** @var Block $block */
            $block = $form->getData();

            $errors = array();
            if($type == 'slider')
            {
                $blockTranslations = $block->getTranslations();
                /** @var BlockTranslation $blockTranslation */
                foreach($blockTranslations as $blockTranslation)
                {
                    $errors = $this->getBlockSliderErrors($blockTranslation->getSlider());
                    if(count($errors) > 0)
                    {
                        break;
                    }
                }
            }

            if(count($errors) > 0) {
                foreach($errors as $error)
                {
                    $form->addError(new FormError($error->getMessage()));
                }
            }else{
                $event = $this->eventDispatcher->dispatchPreEvent(ResourceActions::CREATE, $configuration, $block);

                if ($event->isStopped() && !$configuration->isHtmlRequest()) {
                    throw new HttpException($event->getErrorCode(), $event->getMessage());
                }
                if ($event->isStopped()) {
                    $this->flashHelper->addFlashFromEvent($configuration, $event);

                    if ($event->hasResponse()) {
                        return $event->getResponse();
                    }

                    return $this->redirectHandler->redirectToIndex($configuration, $block);
                }

                if ($configuration->hasStateMachine()) {
                    $this->stateMachine->apply($configuration, $block);
                }

                $this->repository->add($block);
                $postEvent = $this->eventDispatcher->dispatchPostEvent(ResourceActions::CREATE, $configuration, $block);

                if (!$configuration->isHtmlRequest()) {
                    return $this->viewHandler->handle($configuration, View::create($block, Response::HTTP_CREATED));
                }

                $this->flashHelper->addSuccessFlash($configuration, ResourceActions::CREATE, $block);

                if ($postEvent->hasResponse()) {
                    return $postEvent->getResponse();
                }

                return $this->redirectHandler->redirectToResource($configuration, $block);
            }
        }

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create($form, Response::HTTP_BAD_REQUEST));
        }

        $this->eventDispatcher->dispatchInitializeEvent(ResourceActions::CREATE, $configuration, $block);

        if($type == 'slider') {
            $blockTranslations = $block->getTranslations();
            /** @var BlockTranslation $blockTranslation */
            foreach($blockTranslations as $blockTranslation)
            {
                $blockSlider = $blockTranslation->getSlider();
                $blockSlider->orderElements();
            }
        }

        $view = View::create()
            ->setData([
                'configuration' => $configuration,
                'metadata' => $this->metadata,
                'resource' => $block,
                $this->metadata->getName() => $block,
                'form' => $form->createView(),
            ])
            ->setTemplate($configuration->getTemplate(ResourceActions::CREATE . '.html'))
        ;

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function updateAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::UPDATE);
        /** @var Block $block */
        $block = $this->findOr404($configuration);
        $type = $block->getType();

        if($type == 'slider') {
            $blockTranslations = $block->getTranslations();
            /** @var BlockTranslation $blockTranslation */
            foreach($blockTranslations as $blockTranslation)
            {
                /** @var BlockSlider $blockSlider */
                $blockSlider = $blockTranslation->getSlider();
                $this->prepareBlockSliderToFutureCollectionDrops($blockSlider);
            }
        }

        $form = $this->resourceFormFactory->create($configuration, $block);

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && $form->handleRequest($request)->isValid()) {
            /** @var Block $block */
            $block = $form->getData();

            $errors = array();
            if($type == 'slider')
            {
                $blockTranslations = $block->getTranslations();
                /** @var BlockTranslation $blockTranslation */
                foreach($blockTranslations as $blockTranslation)
                {
                    $errors = $this->getBlockSliderErrors($blockTranslation->getSlider());
                    if(count($errors) > 0)
                    {
                        break;
                    }
                }
            }

            if(count($errors) > 0) {
                foreach($errors as $error)
                {
                    $form->addError(new FormError($error->getMessage()));
                }
            }else {
                /** @var EntityManager $em */
                $em = $this->getDoctrine()->getManager();
                if($type == 'slider') {
                    $blockTranslations = $block->getTranslations();
                    /** @var BlockTranslation $blockTranslation */
                    foreach ($blockTranslations as $blockTranslation)
                    {
                        /** @var BlockSlider $blockSlider */
                        $blockSlider = $blockTranslation->getSlider();
                        $this->removeBlockSliderElementsFromBlockSliderDropped($blockSlider, $em, $configuration);
                    }
                }

                /** @var ResourceControllerEvent $event */
                $event = $this->eventDispatcher->dispatchPreEvent(ResourceActions::UPDATE, $configuration, $block);

                if ($event->isStopped() && !$configuration->isHtmlRequest()) {
                    throw new HttpException($event->getErrorCode(), $event->getMessage());
                }
                if ($event->isStopped()) {
                    $this->flashHelper->addFlashFromEvent($configuration, $event);

                    if ($event->hasResponse()) {
                        return $event->getResponse();
                    }

                    return $this->redirectHandler->redirectToResource($configuration, $block);
                }

                try {
                    $this->resourceUpdateHandler->handle($block, $configuration, $this->manager);
                } catch (UpdateHandlingException $exception) {
                    if (!$configuration->isHtmlRequest()) {
                        return $this->viewHandler->handle(
                            $configuration,
                            View::create($form, $exception->getApiResponseCode())
                        );
                    }

                    $this->flashHelper->addErrorFlash($configuration, $exception->getFlash());

                    return $this->redirectHandler->redirectToReferer($configuration);
                }

                $postEvent = $this->eventDispatcher->dispatchPostEvent(ResourceActions::UPDATE, $configuration, $block);

                if (!$configuration->isHtmlRequest()) {
                    $view = $configuration->getParameters()->get('return_content', false) ? View::create($block, Response::HTTP_OK) : View::create(null, Response::HTTP_NO_CONTENT);

                    return $this->viewHandler->handle($configuration, $view);
                }

                $this->flashHelper->addSuccessFlash($configuration, ResourceActions::UPDATE, $block);

                if ($postEvent->hasResponse()) {
                    return $postEvent->getResponse();
                }

                return $this->redirectHandler->redirectToResource($configuration, $block);
            }
        }

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create($form, Response::HTTP_BAD_REQUEST));
        }

        $this->eventDispatcher->dispatchInitializeEvent(ResourceActions::UPDATE, $configuration, $block);

        if($type == 'slider') {
            $blockTranslations = $block->getTranslations();
            /** @var BlockTranslation $blockTranslation */
            foreach($blockTranslations as $blockTranslation)
            {
                $blockSlider = $blockTranslation->getSlider();
                $blockSlider->orderElements();
            }
        }

        $view = View::create()
            ->setData([
                'configuration' => $configuration,
                'metadata' => $this->metadata,
                'resource' => $block,
                $this->metadata->getName() => $block,
                'form' => $form->createView(),
            ])
            ->setTemplate($configuration->getTemplate(ResourceActions::UPDATE . '.html'))
        ;

        return $this->viewHandler->handle($configuration, $view);
    }
}
