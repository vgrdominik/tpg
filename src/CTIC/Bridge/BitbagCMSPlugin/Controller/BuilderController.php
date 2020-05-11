<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Controller;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class BuilderController
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    public function __construct(
        ViewHandlerInterface $viewHandler
    ) {
        $this->viewHandler = $viewHandler;
    }

    public function indexAction(Request $request): Response
    {
        $view = View::create();
        $view->setTemplate('CTICBridgeBitbagCMSPlugin:Builder:index.html.twig');
        return $this->viewHandler->handle($view);
    }
}
