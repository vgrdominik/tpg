<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Resolver;

use BitBag\SyliusCmsPlugin\Entity\BlockInterface as BitBagBlockInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;
use BitBag\SyliusCmsPlugin\Exception\TemplateTypeNotFound;
use BitBag\SyliusCmsPlugin\Resolver\BlockTemplateResolverInterface as BitBagBlockTemplateResolverInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSliderInterface;

final class BlockTemplateResolver implements BlockTemplateResolverInterface, BitBagBlockTemplateResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolveTemplate(BitBagBlockInterface $block): string
    {
        if (BitBagBlockInterface::TEXT_BLOCK_TYPE === $block->getType()) {
            return BitBagBlockTemplateResolverInterface::TEXT_BLOCK_TEMPLATE;
        }

        if (BitBagBlockInterface::HTML_BLOCK_TYPE === $block->getType()) {
            return BitBagBlockTemplateResolverInterface::HTML_BLOCK_TEMPLATE;
        }

        if (BitBagBlockInterface::IMAGE_BLOCK_TYPE === $block->getType()) {
            return BitBagBlockTemplateResolverInterface::IMAGE_BLOCK_TEMPLATE;
        }

        if (BlockSliderInterface::SLIDER_BLOCK_TYPE === $block->getType()) {
            return BlockTemplateResolverInterface::SLIDER_BLOCK_TEMPLATE;
        }

        if (BlockInterface::TAXON_BLOCK_TYPE === $block->getType()) {
            return BlockTemplateResolverInterface::TAXON_BLOCK_TEMPLATE;
        }

        if (BlockInterface::PAGE_BLOCK_TYPE === $block->getType()) {
            return BlockTemplateResolverInterface::PAGE_BLOCK_TEMPLATE;
        }

        throw new TemplateTypeNotFound($block->getType());
    }
}
