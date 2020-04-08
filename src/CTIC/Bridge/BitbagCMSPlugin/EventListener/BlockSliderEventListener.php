<?php

namespace CTIC\Bridge\BitbagCMSPlugin\EventListener;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSlider;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSliderElement;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

class BlockSliderEventListener
{
    public function postFlush(PostFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $lastEntitiesFlushed = $em->getUnitOfWork()->getIdentityMap();
        if(!is_array($lastEntitiesFlushed))
        {
            return;
        }
        $blockSliders = end($lastEntitiesFlushed);

        if (is_array($blockSliders) && current($blockSliders) instanceof BlockSlider) {
            $entityManager = $args->getEntityManager();

            $updates = false;
            foreach($blockSliders as $blockSlider){
                /** @var BlockSliderElement $tmpElement */
                foreach($blockSlider->tmpElements as $tmpElement){
                    $updates = true;
                    $tmpElement->setOwner($blockSlider);
                    $blockSlider->addElements($tmpElement);

                    $entityManager->persist($tmpElement);
                }
            }

            if($updates == true)
            {
                $entityManager->flush();
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var BlockSlider $blockSlider */
        $blockSlider = $args->getEntity();

        // only act on some "BlockSlider" entity
        if (!$blockSlider instanceof BlockSlider) {
            return;
        }

        $blockSlider->tmpElements = $blockSlider->getElements();
        $blockSlider->initializeElementsCollection();
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->prePersist($args);
    }
}