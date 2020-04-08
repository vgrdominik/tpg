<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use CTIC\Bridge\BitbagCMSPlugin\Entity\HomeInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface HomeRepositoryInterface extends RepositoryInterface
{
    /**
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder(): QueryBuilder;
}
