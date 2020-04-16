<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class BrandingMenuBuilder
{
    /**
     * @param MenuBuilderEvent $menuBuilderEvent
     */
    public function buildMenu(MenuBuilderEvent $menuBuilderEvent): void
    {
        $menu = $menuBuilderEvent->getMenu();

        $configRootMenuItem = $menu
            ->getChild('configuration')
        ;

        $configRootMenuItem
            ->addChild('branding', [
                'route' => 'ctic_bridge_sylius_bundle_admin_branding_index',
            ])
            ->setLabel('ctic_bridge_sylius_bundle.ui.branding')
            ->setLabelAttribute('icon', 'block layout')
        ;
    }
}
