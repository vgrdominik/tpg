<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

interface BlockableInterface
{
    /**
     * @return string|null
     */
    public function getType();

    /**
     * @return void
     */
    public function setType();

    /**
     * @return Block|null
     */
    public function getBlock();

    /**
     * @param Block|null $block
     */
    public function setBlock(Block $block): void;
}
