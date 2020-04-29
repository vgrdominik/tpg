<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Resolver;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;

interface BlockResourceResolverInterface
{
    public function findOrLog(string $code): ?BlockInterface;
}
