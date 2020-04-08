<?php

namespace CTIC\Bridge\BitbagCMSPlugin\EventListener;

use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingElement;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

class LandingElementEventListener
{
    public function postFlush(PostFlushEventArgs $args)
    {
        /** @var LandingElement $landingElement */
        $em = $args->getEntityManager();
        $lastEntitiesFlushed = $em->getUnitOfWork()->getIdentityMap();
        if(!is_array($lastEntitiesFlushed))
        {
            return;
        }
        $landingElement = end($lastEntitiesFlushed);
        $landingElement = end($landingElement);

        // only act on some "Landing" entity
        if (!$landingElement instanceof LandingElement) {
            return;
        }

        $entityManager = $args->getEntityManager();

        foreach($landingElement->tmpChildren as $tmpChildren)
        {
            $tmpChildren->setParent($landingElement);
            $landingElement->addChildren($tmpChildren);

            $entityManager->persist($tmpChildren);
            $entityManager->flush();
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var LandingElement $landingElement */
        $landingElement = $args->getEntity();

        // only act on some "Landing" entity
        if (!$landingElement instanceof LandingElement) {
            return;
        }

        $landingElement->tmpChildren = $landingElement->getChildren();
        $landingElement->initializeChildrenCollection();
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->prePersist($args);
    }
}