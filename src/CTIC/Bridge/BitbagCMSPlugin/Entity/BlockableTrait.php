<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

trait BlockableTrait
{
    /**
     * @var Block|null
     */
    protected $block;

    /**
     * @return Block|null
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @param Block|null $block
     */
    public function setBlock(Block $block): void
    {
        $this->block = $block;
    }
}
