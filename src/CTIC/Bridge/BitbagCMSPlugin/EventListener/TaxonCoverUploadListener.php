<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\EventListener;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;
use BitBag\SyliusCmsPlugin\Entity\BlockTranslationInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\TaxonCover;
use CTIC\Bridge\BitbagCMSPlugin\Entity\TaxonInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Webmozart\Assert\Assert;

final class TaxonCoverUploadListener
{
    /**
     * @var ImageUploaderInterface
     */
    private $uploader;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param ImageUploaderInterface $uploader
     * @param EntityManagerInterface $em
     */
    public function __construct(ImageUploaderInterface $uploader, EntityManagerInterface $em)
    {
        $this->uploader = $uploader;
        $this->em = $em;
    }

    /**
     * @param ResourceControllerEvent $event
     */
    public function uploadImage(ResourceControllerEvent $event): void
    {
        /** @var TaxonInterface $taxon */
        $taxon = $event->getSubject();

        Assert::isInstanceOf($taxon, TaxonInterface::class);

        /** @var TaxonCover $image */
        $image = $taxon->getCover();

        if (null !== $image && true === $image->hasFile()) {
            $this->uploader->upload($image);
            if ($image->getPath()) {
                $this->em->persist($image);
                $this->em->flush();
            }
        }else{
            $path = $image->getPath();
            if($path === null)
            {
                $image->setPath('');
            }
        }
    }
}
