<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;
use BitBag\SyliusCmsPlugin\Repository\BlockRepository as BaseBlockRepository;
use Doctrine\ORM\QueryBuilder;

class BlockRepository extends BaseBlockRepository implements BlockRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findByNamePart(string $phrase, ?string $locale = null): array
    {
        return $this->createTranslationBasedQueryBuilder($locale)
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param $locale
     *
     * @return QueryBuilder
     */
    private function createTranslationBasedQueryBuilder($locale): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation')
        ;

        if (null !== $locale) {
            $queryBuilder
                ->andWhere('translation.locale = :locale')
                ->setParameter('locale', $locale)
            ;
        }

        return $queryBuilder;
    }
}
