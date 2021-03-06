<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\Taxon as BaseTaxon;

class Taxon extends BaseTaxon implements TaxonInterface
{
    /**
     * @var Collection|BlockTranslationInterface[]
     */
    protected $blocks = '';

    /**
     * @var TaxonCover
     */
    protected $cover;

    /**
     * @var Landing
     */
    protected $landing;

    public function __construct()
    {
        parent::__construct();

        $this->initializeBlocksCollection();
    }

    /**
     * @inheritdoc
     */
    public function initializeBlocksCollection(): void
    {
        $this->blocks = new ArrayCollection();
    }

    /**
     * @inheritdoc
     */
    public function getBlocks(): ?Collection
    {
        return $this->blocks;
    }

    /**
     * @inheritdoc
     */
    public function setBlocks($blocks): void
    {
        $this->initializeBlocksCollection();
        foreach($blocks as $children)
        {
            $this->addBlocks($children);
        }
    }

    /**
     * @inheritdoc
     */
    public function hasBlocks(BlockTranslationInterface $blocks): ?bool
    {
        return $this->blocks->contains($blocks);
    }

    /**
     * @inheritdoc
     */
    public function addBlocks(BlockTranslationInterface $blocks): void
    {
        $this->blocks->add($blocks);
    }

    /**
     * @inheritdoc
     */
    public function removeBlocks(BlockTranslationInterface $blocks): void
    {
        if (true === $this->hasBlocks($blocks)) {
            $this->blocks->removeElement($blocks);
        }
    }

    /**
     * @inheritdoc
     */
    public function getCover(): ?TaxonCoverInterface
    {
        return $this->cover;
    }

    /**
     * @inheritdoc
     */
    public function setCover(TaxonCoverInterface $cover): void
    {
        if ($cover !== null) {
            $cover->setOwner($this);
        }

        $this->cover = $cover;
    }

    /**
     * @inheritdoc
     */
    public function getLanding()
    {
        return $this->landing;
    }

    /**
     * @inheritdoc
     */
    public function setLanding(Landing $landing): void
    {
        $this->landing = $landing;
    }
}
