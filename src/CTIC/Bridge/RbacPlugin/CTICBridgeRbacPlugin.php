<?php
declare(strict_types=1);

namespace CTIC\Bridge\RbacPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CTICBridgeRbacPlugin extends Bundle
{
    use SyliusPluginTrait;
}
