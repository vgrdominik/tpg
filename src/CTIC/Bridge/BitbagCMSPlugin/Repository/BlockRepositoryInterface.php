<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface BlockRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $phrase
     * @param string|null $locale
     *
     * @return BlockInterface[]
     */
    public function findByNamePart(string $phrase, ?string $locale = null): array;
}
