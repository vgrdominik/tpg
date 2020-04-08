<?php
declare(strict_types=1);

namespace CTIC\Bridge\SyliusComponent;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CTICBridgeSyliusComponent extends Bundle
{
    use SyliusPluginTrait;
}
