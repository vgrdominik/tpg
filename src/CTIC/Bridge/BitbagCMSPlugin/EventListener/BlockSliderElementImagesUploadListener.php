<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\EventListener;

use BitBag\SyliusCmsPlugin\Entity\Block;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSlider;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockTranslation;
use Sylius\Component\Core\Model\ImagesAwareInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class BlockSliderElementImagesUploadListener
{
    /**
     * @var ImageUploaderInterface
     */
    private $uploader;

    /**
     * @param ImageUploaderInterface $uploader
     */
    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param GenericEvent $event
     */
    public function uploadImages(GenericEvent $event): void
    {
        /** @var Block $subject */
        $subject = $event->getSubject();
        $blockTranslations = $subject->getTranslations();

        /** @var BlockTranslation $blockTranslation */
        foreach($blockTranslations as $blockTranslation)
        {
            $blockSlider = $blockTranslation->getSlider();
            if(empty($blockSlider) || !$blockSlider instanceof BlockSlider)
            {
                continue;
            }

            $blockSliderElements = $blockSlider->getElements();
            foreach($blockSliderElements as $blockSliderElement)
            {
                Assert::isInstanceOf($blockSliderElement, ImagesAwareInterface::class);

                $this->uploadSubjectImages($blockSliderElement);
            }
        }
    }

    /**
     * @param ImagesAwareInterface $subject
     */
    private function uploadSubjectImages(ImagesAwareInterface $subject): void
    {
        $images = $subject->getImages();
        foreach ($images as $image) {
            if ($image->hasFile()) {
                $this->uploader->upload($image);
            }

            // Upload failed? Let's remove that image.
            if (null === $image->getPath()) {
                $images->removeElement($image);
            }
        }
    }
}
