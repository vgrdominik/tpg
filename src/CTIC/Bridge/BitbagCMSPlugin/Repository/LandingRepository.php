<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class LandingRepository extends EntityRepository implements LandingRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('l');
    }
    /**
     * {@inheritdoc}
     */
    public function findByNamePart(string $phrase): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->getQuery()
            ->getResult()
            ;
    }
}
