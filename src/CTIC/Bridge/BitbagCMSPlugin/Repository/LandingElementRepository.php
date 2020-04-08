<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Repository;

use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingElementInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class LandingElementRepository extends EntityRepository implements LandingElementRepositoryInterface
{

}
