<?php
declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CTICBridgeSyliusBundle extends Bundle
{
    use SyliusPluginTrait;
}
