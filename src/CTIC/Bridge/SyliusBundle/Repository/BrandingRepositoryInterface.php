<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Repository;

use CTIC\Bridge\SyliusBundle\Entity\brandingInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface BrandingRepositoryInterface extends RepositoryInterface
{
    /**
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder(): QueryBuilder;
}
