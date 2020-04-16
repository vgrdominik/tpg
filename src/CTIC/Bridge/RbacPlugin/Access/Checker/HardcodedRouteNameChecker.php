<?php

declare(strict_types=1);

namespace CTIC\Bridge\RbacPlugin\Access\Checker;

use Sylius\RbacPlugin\Access\Checker\RouteNameCheckerInterface;

final class HardcodedRouteNameChecker implements RouteNameCheckerInterface
{
    public function isAdminRoute(string $routeName): bool
    {
        return
            strpos($routeName, 'sylius_admin') !== false ||
            strpos($routeName, 'sylius_rbac_admin') !== false ||
            strpos($routeName, 'bitbag_sylius_cms_plugin_admin') !== false ||
            strpos($routeName, 'ctic_bridge_bitbag_cms_plugin_admin') !== false ||
            strpos($routeName, 'ctic_bridge_sylius_bundle_admin_branding') !== false
        ;
    }
}
