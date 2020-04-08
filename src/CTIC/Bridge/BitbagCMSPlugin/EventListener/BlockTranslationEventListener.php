<?php

namespace CTIC\Bridge\BitbagCMSPlugin\EventListener;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSlider;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockTranslation;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;

class BlockTranslationEventListener
{
    public function postFlush(PostFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $lastEntitiesFlushed = $em->getUnitOfWork()->getIdentityMap();
        if(!is_array($lastEntitiesFlushed))
        {
            return;
        }
        $blockTranslations = end($lastEntitiesFlushed);

        // only act on some "BlockSlider" entity
        if (is_array($blockTranslations) && current($blockTranslations) instanceof BlockTranslation) {
            $entityManager = $args->getEntityManager();

            $updates = false;
            foreach($blockTranslations as $blockTranslation) {
                $blockSlider = $blockTranslation->tmpSlider;

                // only act on some "BlockSlider" entity
                if (!empty($blockSlider) && $blockSlider instanceof BlockSlider) {
                    $updates = true;
                    $blockSlider->setSlideOwner($blockTranslation);
                    $entityManager->persist($blockSlider);
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
        /** @var BlockTranslation $blockTranslation */
        $blockTranslation = $args->getEntity();

        // only act on some "BlockSlider" entity
        if (!$blockTranslation instanceof BlockTranslation) {
            return;
        }

        $slider = $blockTranslation->getSlider();
        // only act on some "BlockSlider" entity
        if (!empty($slider) && $slider instanceof BlockSlider) {
            $blockTranslation->tmpSlider = $slider;
            $blockTranslation->setSlider(null);
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->prePersist($args);
    }
}