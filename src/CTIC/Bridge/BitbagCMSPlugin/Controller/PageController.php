<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Controller;

use BitBag\SyliusCmsPlugin\Entity\PageImageInterface;
use BitBag\SyliusCmsPlugin\Entity\PageInterface;
use FOS\RestBundle\View\View;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PageController extends ResourceController
{
    public function renderLinkAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::SHOW);

        $code = $request->get('code');
        $pageResourceResolver = $this->get('bitbag_sylius_cms_plugin.resolver.page_resource');

        $page = $pageResourceResolver->findOrLog($code);

        if (null === $page) {
            return new Response();
        }

        $this->eventDispatcher->dispatch(ResourceActions::SHOW, $configuration, $page);

        $view = View::create($page);

        if ($configuration->isHtmlRequest()) {
            $view
                ->setTemplate($configuration->getTemplate(ResourceActions::SHOW . '.html'))
                ->setTemplateVar($this->metadata->getName())
                ->setData([
                    'configuration' => $configuration,
                    'metadata' => $this->metadata,
                    'resource' => $page,
                    $this->metadata->getName() => $page,
                ])
            ;
        }

        return $this->viewHandler->handle($configuration, $view);
    }

    public function previewAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::CREATE);

        /** @var PageInterface $page */
        $page = $request->get('id') && $this->repository->find($request->get('id')) ?
            $this->repository->find($request->get('id')) :
            $this->factory->createNew();
        $form = $this->resourceFormFactory->create($configuration, $page);
        $defaultLocale = $this->getParameter('locale');

        $form->handleRequest($request);

        $page->setFallbackLocale($request->get('_locale', $defaultLocale));
        $page->setCurrentLocale($request->get('_locale', $defaultLocale));

        $this->resolveImage($page);

        $this->get('bitbag_sylius_cms_plugin.controller.helper.form_errors_flash')->addFlashErrors($form);

        $view = View::create()
            ->setData([
                'resource' => $page,
                'preview' => true,
                $this->metadata->getName() => $page,
            ])
            ->setTemplate($configuration->getTemplate(ResourceActions::CREATE . '.html'))
        ;

        return $this->viewHandler->handle($configuration, $view);
    }

    private function resolveImage(PageInterface $page): void
    {
        /** @var PageImageInterface $image */
        $image = $page->getTranslation()->getImage();

        if (!$image || !$image->getPath()) {
            return;
        }

        $file = $image->getFile() ?: new File($this->getParameter('sylius_core.public_dir') . '/media/image/' . $image->getPath());
        $base64Content = base64_encode(file_get_contents($file->getPathname()));
        $path = 'data:' . $file->getMimeType() . ';base64, ' . $base64Content;

        $image->setPath($path);
        $page->getTranslation()->setImage($image);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function searchProductAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $productRepository = $this->get('sylius.repository.product');
        $locale = $this->get('sylius.context.locale')->getLocaleCode();
        $resource = $productRepository->findByNamePart($request->get('phrase', ''), $locale);

        $view = View::create($resource);

        return $this->viewHandler->handle($configuration, $view);
    }

    /**
     * @param Request $request
     *
     * @return Response
    public function getProductAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $id = $request->get('id', '');
        $productRepository = $this->get('sylius.repository.product');
        if(is_array($id) && count($id) > 0)
        {
            $id = array_pop($id);
            $resource = array($productRepository->find($id));
        }else{
            $resource = null;
        }

        $view = View::create($resource);

        return $this->viewHandler->handle($configuration, $view);
    }
     */
}
