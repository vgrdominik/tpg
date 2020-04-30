<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use BitBag\SyliusCmsPlugin\Entity\PageInterface;
use BitBag\SyliusCmsPlugin\Repository\PageRepository as BasePageRepository;
use BitBag\SyliusCmsPlugin\Repository\PageRepositoryInterface as BasePageRepositoryInterface;

class PageRepository extends BasePageRepository implements BasePageRepositoryInterface, PageRepositoryInterface
{
    public function findOneEnabledBySlug(
        string $slug,
        ?string $localeCode
    ): ?PageInterface {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation')
            ->where('translation.locale = :localeCode')
            ->andWhere('translation.slug = :slug')
            ->andWhere('o.enabled = true')
            ->setParameter('localeCode', $localeCode)
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
