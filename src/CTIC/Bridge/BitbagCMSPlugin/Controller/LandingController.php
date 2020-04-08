<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Controller;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSliderInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockTranslationInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\Landing;
use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingElement;
use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingElementInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingInterface;
use CTIC\Bridge\BitbagCMSPlugin\Form\Type\LandingType;
use CTIC\Bridge\BitbagCMSPlugin\Repository\LandingRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Resource\Exception\UpdateHandlingException;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpKernel\Exception\HttpException;
use FOS\RestBundle\View\View;

final class LandingController extends ResourceController
{

    /**
     * @var LandingRepository
     */
    protected $repository;

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

        $id = $request->get('id', '');
        if(is_array($id) && count($id) > 0)
        {
            $id = array_pop($id);
            $resource = array($this->repository->find($id));
        }else{
            $resource = null;
        }

        $view = View::create($resource);

        return $this->viewHandler->handle($configuration, $view);
    }

    private function getLandingErrors(LandingInterface $landing)
    {
        $validator = $this->get('validator');
        $landingElements = $landing->getElements();
        $errors = array();
        foreach($landingElements as $landingElement)
        {
            $landingElement->setLanding($landing);
            $errors = $validator->validate($landingElement, null, array('cticbridgebitbag'));
            if(count($errors) > 0) {
                break;
            }
            $landingElementChildrens = $landingElement->getChildren();
            foreach($landingElementChildrens as $landingElementChildren)
            {
                $landingElementChildren->setLanding();
                $landingElementChildren->setParent($landingElement);
                $errors = $validator->validate($landingElementChildren, null, array('cticbridgebitbag'));
                if(count($errors) > 0) {
                    break 2;
                }
            }
        }

        return $errors;
    }

    private function prepareLandingToFutureCollectionDrops(Landing $landing): void
    {
        $elements = $landing->getElements();
        $elementToTmp = array();

        /** @var LandingElement $element */
        foreach($elements as $element)
        {
            $elementToTmp[] = $element;

            $childrens = $element->getChildren();
            $childrensToTmp = array();
            foreach($childrens as $children)
            {
                $childrensToTmp[] = $children;
            }
            $element->tmpChildren = $childrensToTmp;
        }

        $landing->tmpElements = $elementToTmp;
    }

    private function removeLandingElementsFromLandingDropped(Landing $landing, EntityManager $em, RequestConfiguration $configuration): void
    {
        $initialElements = $landing->tmpElements;

        /** @var LandingElement $initialElement */
        foreach($initialElements as $initialElement)
        {
            if($landing->hasElements($initialElement))
            {
                $this->removeLandingElementsFromLandingElementDropped($initialElement, $em, $configuration);
            }else{
                try{
                    $initialChildrens = $initialElement->tmpChildren;
                    foreach($initialChildrens as $initialChildren)
                    {
                        $em->remove($initialChildren);
                    }
                    $em->remove($initialElement);
                    $em->flush();
                }catch (ORMException $e)
                {
                    $this->flashHelper->addErrorFlash($configuration, $e->getMessage());
                }
            }
        }
    }

    private function removeLandingElementsFromLandingElementDropped(LandingElement $landingElement, EntityManager $em, RequestConfiguration $configuration): void
    {
        $initialChildrens = $landingElement->tmpChildren;

        foreach($initialChildrens as $initialChildren)
        {
            if(!$landingElement->hasChildren($initialChildren))
            {
                try{
                    $em->remove($initialChildren);
                }catch (ORMException $e)
                {
                    $this->flashHelper->addErrorFlash($configuration, $e->getMessage());
                }
            }
        }

        try{
            $em->flush();
        }catch (ORMException $e)
        {
            $this->flashHelper->addErrorFlash($configuration, $e->getMessage());
        }
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::CREATE);
        $landing = $this->newResourceFactory->create($configuration, $this->factory);

        $form = $this->resourceFormFactory->create($configuration, $landing);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            /** @var Landing $landing */
            $landing = $form->getData();

            $errors = $this->getLandingErrors($landing);

            if(count($errors) > 0) {
                foreach($errors as $error)
                {
                    $form->addError(new FormError($error->getMessage()));
                }
            }else{
                $event = $this->eventDispatcher->dispatchPreEvent(ResourceActions::CREATE, $configuration, $landing);

                if ($event->isStopped() && !$configuration->isHtmlRequest()) {
                    throw new HttpException($event->getErrorCode(), $event->getMessage());
                }
                if ($event->isStopped()) {
                    $this->flashHelper->addFlashFromEvent($configuration, $event);

                    if ($event->hasResponse()) {
                        return $event->getResponse();
                    }

                    return $this->redirectHandler->redirectToIndex($configuration, $landing);
                }

                if ($configuration->hasStateMachine()) {
                    $this->stateMachine->apply($configuration, $landing);
                }

                $this->repository->add($landing);
                $postEvent = $this->eventDispatcher->dispatchPostEvent(ResourceActions::CREATE, $configuration, $landing);

                if (!$configuration->isHtmlRequest()) {
                    return $this->viewHandler->handle($configuration, View::create($landing, Response::HTTP_CREATED));
                }

                $this->flashHelper->addSuccessFlash($configuration, ResourceActions::CREATE, $landing);

                if ($postEvent->hasResponse()) {
                    return $postEvent->getResponse();
                }

                return $this->redirectHandler->redirectToResource($configuration, $landing);
            }
        }

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create($form, Response::HTTP_BAD_REQUEST));
        }

        $this->eventDispatcher->dispatchInitializeEvent(ResourceActions::CREATE, $configuration, $landing);

        $landing->orderElements();

        $view = View::create()
            ->setData([
                'configuration' => $configuration,
                'metadata' => $this->metadata,
                'resource' => $landing,
                $this->metadata->getName() => $landing,
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
        /** @var Landing $landing */
        $landing = $this->findOr404($configuration);

        $this->prepareLandingToFutureCollectionDrops($landing);

        $form = $this->resourceFormFactory->create($configuration, $landing);

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && $form->handleRequest($request)->isValid()) {
            /** @var Landing $landing */
            $landing = $form->getData();

            $errors = $this->getLandingErrors($landing);

            if(count($errors) > 0) {
                foreach($errors as $error)
                {
                    $form->addError(new FormError($error->getMessage()));
                }
            }else {
                $em = $this->getDoctrine()->getManager();
                $this->removeLandingElementsFromLandingDropped($landing, $em, $configuration);

                /** @var ResourceControllerEvent $event */
                $event = $this->eventDispatcher->dispatchPreEvent(ResourceActions::UPDATE, $configuration, $landing);

                if ($event->isStopped() && !$configuration->isHtmlRequest()) {
                    throw new HttpException($event->getErrorCode(), $event->getMessage());
                }
                if ($event->isStopped()) {
                    $this->flashHelper->addFlashFromEvent($configuration, $event);

                    if ($event->hasResponse()) {
                        return $event->getResponse();
                    }

                    return $this->redirectHandler->redirectToResource($configuration, $landing);
                }

                try {
                    $this->resourceUpdateHandler->handle($landing, $configuration, $this->manager);
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

                $postEvent = $this->eventDispatcher->dispatchPostEvent(ResourceActions::UPDATE, $configuration, $landing);

                if (!$configuration->isHtmlRequest()) {
                    $view = $configuration->getParameters()->get('return_content', false) ? View::create($landing, Response::HTTP_OK) : View::create(null, Response::HTTP_NO_CONTENT);

                    return $this->viewHandler->handle($configuration, $view);
                }

                $this->flashHelper->addSuccessFlash($configuration, ResourceActions::UPDATE, $landing);

                if ($postEvent->hasResponse()) {
                    return $postEvent->getResponse();
                }

                return $this->redirectHandler->redirectToResource($configuration, $landing);
            }
        }

        if (!$configuration->isHtmlRequest()) {
            return $this->viewHandler->handle($configuration, View::create($form, Response::HTTP_BAD_REQUEST));
        }

        $this->eventDispatcher->dispatchInitializeEvent(ResourceActions::UPDATE, $configuration, $landing);

        $landing->orderElements();

        $view = View::create()
            ->setData([
                'configuration' => $configuration,
                'metadata' => $this->metadata,
                'resource' => $landing,
                $this->metadata->getName() => $landing,
                'form' => $form->createView(),
            ])
            ->setTemplate($configuration->getTemplate(ResourceActions::UPDATE . '.html'))
        ;

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @param integer $id
     *
     * @return Response
     */
    public function previewAction(Request $request, $id = null): Response
    {
        if($id === null)
        {
            $landing = new Landing();
        }else{
            $landing = $this->repository->find($id);
        }

        $form = $this->createForm(LandingType::class, $landing);

        if (in_array($request->getMethod(), ['POST', 'PUT'], true) && $form->handleRequest($request)) {
            $landing->orderElements();

            return $this->render(
                '@CTICBridgeBitbagCMSPlugin/Landing/landing.html.twig',
                array('landing' => $landing)
            );
        }

        throw $this->createNotFoundException("Can't generate landing.");
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function renderPreviewAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::SHOW);

        /** @var Landing $landing */
        $landing = $this->findOr404($configuration);

        $landing->orderElements();

        return $this->render(
            '@CTICBridgeBitbagCMSPlugin/Landing/landing.html.twig',
            array('landing' => $landing)
        );
    }
}
