<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class ContentManagementMenuBuilder
{
    /**
     * @param MenuBuilderEvent $menuBuilderEvent
     */
    public function buildMenu(MenuBuilderEvent $menuBuilderEvent): void
    {
        $menu = $menuBuilderEvent->getMenu();

        $cmsRootMenuItem = $menu
            ->getChild('bitbag_cms')
        ;

        $cmsRootMenuItem
            ->addChild('landings', [
                'route' => 'ctic_bridge_bitbag_cms_plugin_admin_landing_index',
            ])
            ->setLabel('ctic_bridge_bitbag_cms_plugin.ui.landings')
            ->setLabelAttribute('icon', 'block layout')
        ;

        $cmsRootMenuItem
            ->addChild('home', [
                'route' => 'ctic_bridge_bitbag_cms_plugin_admin_home_index',
            ])
            ->setLabel('ctic_bridge_bitbag_cms_plugin.ui.home')
            ->setLabelAttribute('icon', 'block layout')
        ;

        $cmsRootMenuItem
            ->addChild('html_builder', [
                'route' => 'ctic_bridge_bitbag_cms_plugin_admin_builder_index',
            ])
            ->setLabel('ctic_bridge_bitbag_cms_plugin.ui.html_builder')
            ->setLabelAttribute('icon', 'block layout')
        ;
    }
}
