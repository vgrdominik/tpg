<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\Page as BasePage;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Page extends BasePage implements PageInterface
{
    /**
     * @var Collection|BlockTranslationInterface[]
     */
    protected $blocks = '';

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
     * @return Landing
     */
    public function getLanding()
    {
        return $this->landing;
    }

    /**
     * @param Landing $landing
     */
    public function setLanding(Landing $landing): void
    {
        $this->landing = $landing;
    }
}