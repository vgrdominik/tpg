<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use BitBag\SyliusCmsPlugin\Entity\PageInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface PageRepositoryInterface
{
    public function findOneEnabledBySlug(
        string $slug,
        ?string $localeCode
    ): ?PageInterface;
}
