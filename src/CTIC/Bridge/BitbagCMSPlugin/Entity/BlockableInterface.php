<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\Block;

interface BlockableInterface
{
    /**
     * @return Block|null
     */
    public function getBlock();

    /**
     * @param Block|null $block
     */
    public function setBlock(Block $block): void;
}
