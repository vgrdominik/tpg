<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Sylius\Component\Core\Model\TaxonInterface;

interface BlockTranslationInterface
{
    /**
     * @return BlockSliderInterface|null
     */
    public function getSlider(): ?BlockSliderInterface;

    /**
     * @param BlockSliderInterface|null $slider
     */
    public function setSlider(?BlockSliderInterface $slider): void;

    /**
     * @return TaxonInterface|null
     */
    public function getTaxon(): ?TaxonInterface;

    /**
     * @param TaxonInterface|null $taxon
     */
    public function setTaxon(?TaxonInterface $taxon): void;

    /**
     * @return PageInterface|null
     */
    public function getPage(): ?PageInterface;

    /**
     * @param PageInterface|null $page
     */
    public function setPage(?PageInterface $page): void;
}
