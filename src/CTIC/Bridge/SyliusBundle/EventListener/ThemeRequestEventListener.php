<?php

namespace CTIC\Bridge\SyliusBundle\EventListener;

use Sylius\Bundle\ThemeBundle\Context\SettableThemeContext;
use Sylius\Bundle\ThemeBundle\Repository\ThemeRepositoryInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

final class ThemeRequestEventListener
{
    /**
     * @var ThemeRepositoryInterface
     */
    private $themeRepository;

    /**
     * @var SettableThemeContext
     */
    private $themeContext;

    /**
     * @param ThemeRepositoryInterface $themeRepository
     * @param SettableThemeContext $themeContext
     */
    public function __construct(ThemeRepositoryInterface $themeRepository, SettableThemeContext $themeContext)
    {
        $this->themeRepository = $themeRepository;
        $this->themeContext = $themeContext;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            // don't do anything if it's not the master request
            return;
        }

        $this->themeContext->setTheme(
            $this->themeRepository->findOneByName('ctic/yukio-theme')
        );
    }
}