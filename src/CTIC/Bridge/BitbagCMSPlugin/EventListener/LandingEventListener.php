<?php

namespace CTIC\Bridge\BitbagCMSPlugin\EventListener;

use CTIC\Bridge\BitbagCMSPlugin\Entity\Landing;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

class LandingEventListener
{
    public function postFlush(PostFlushEventArgs $args)
    {
        /** @var Landing $landing */
        $em = $args->getEntityManager();
        $lastEntitiesFlushed = $em->getUnitOfWork()->getIdentityMap();
        if(!is_array($lastEntitiesFlushed))
        {
            return;
        }
        $landing = end($lastEntitiesFlushed);
        $landing = end($landing);

        // only act on some "Landing" entity
        if (!$landing instanceof Landing) {
            return;
        }

        $entityManager = $args->getEntityManager();

        foreach($landing->tmpElements as $tmpElement)
        {
            $tmpElement->setLanding($landing);
            $landing->addElements($tmpElement);

            $entityManager->persist($tmpElement);
            $entityManager->flush();
        }

        /*$landingElements = $landing->getElements();

        foreach($landingElements as $landingElement)
        {
            $landingElement->setLanding($landing);
        }*/
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var Landing $landing */
        $landing = $args->getEntity();

        // only act on some "Landing" entity
        if (!$landing instanceof Landing) {
            return;
        }

        $landing->tmpElements = $landing->getElements();
        $landing->initializeElementsCollection();
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->prePersist($args);
    }
}