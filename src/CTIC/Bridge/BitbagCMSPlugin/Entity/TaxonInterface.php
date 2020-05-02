<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Doctrine\Common\Collections\Collection;

interface TaxonInterface
{
    /**
     * @return void
     */
    public function initializeBlocksCollection(): void;

    /**
     * @return Collection|BlockTranslationInterface[]
     */
    public function getBlocks(): ?Collection;

    /**
     * @param Collection|BlockTranslationInterface[]
     */
    public function setBlocks($elements): void;

    /**
     * @param BlockTranslationInterface $block
     *
     * @return bool
     */
    public function hasBlocks(BlockTranslationInterface $block): ?bool;

    /**
     * @param BlockTranslationInterface $block
     */
    public function addBlocks(BlockTranslationInterface $block): void;

    /**
     * @param BlockTranslationInterface $block
     */
    public function removeBlocks(BlockTranslationInterface $block): void;

    /**
     * @return TaxonCoverInterface
     */
    public function getCover(): ?TaxonCoverInterface;

    /**
     * @param TaxonCoverInterface $cover
     */
    public function setCover(TaxonCoverInterface $cover): void;

    /**
     * @return Landing
     */
    public function getLanding();

    /**
     * @param Landing $landing
     */
    public function setLanding(Landing $landing): void;
}
