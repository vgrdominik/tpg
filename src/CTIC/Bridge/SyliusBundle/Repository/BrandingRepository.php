<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Repository;

use CTIC\Bridge\SyliusBundle\Entity\BrandingInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class BrandingRepository extends EntityRepository implements BrandingRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('l');
    }

}
