<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use CTIC\Bridge\BitbagCMSPlugin\Entity\HomeInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class HomeRepository extends EntityRepository implements HomeRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('l');
    }

}
