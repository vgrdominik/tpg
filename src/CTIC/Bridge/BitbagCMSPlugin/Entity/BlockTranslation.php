<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\BlockTranslation as BaseBlockTranslation;
use Sylius\Component\Core\Model\Taxon;
use Sylius\Component\Core\Model\TaxonInterface;

class BlockTranslation extends BaseBlockTranslation implements BlockTranslationInterface
{
    /**
     * @var BlockSliderInterface|null
     */
    public $tmpSlider;

    /**
     * @var BlockSliderInterface|null
     */
    protected $slider;

    /**
     * @var Taxon|null
     */
    protected $taxon;

    /**
     * @var Page|null
     */
    protected $page;

    /**
     * {@inheritdoc}
     */
    public function getSlider(): ?BlockSliderInterface
    {
        return $this->slider;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlider(?BlockSliderInterface $slider): void
    {
        if($slider != null)
        {
            $slider->setSlideOwner($this);
        }

        $this->slider = $slider;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxon(): ?TaxonInterface
    {
        return $this->taxon;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxon(?TaxonInterface $taxon): void
    {
        $this->taxon = $taxon;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage(): ?PageInterface
    {
        return $this->page;
    }

    /**
     * {@inheritdoc}
     */
    public function setPage(?PageInterface $page): void
    {
        $this->page = $page;
    }
}
