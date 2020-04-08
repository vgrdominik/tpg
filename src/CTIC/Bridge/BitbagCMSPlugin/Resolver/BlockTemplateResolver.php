<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Resolver;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSliderInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

final class BlockTemplateResolver implements BlockTemplateResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolveTemplate(BlockInterface $block): string
    {
        if (BlockInterface::TEXT_BLOCK_TYPE === $block->getType()) {
            return BlockTemplateResolverInterface::TEXT_BLOCK_TEMPLATE;
        }

        if (BlockInterface::HTML_BLOCK_TYPE === $block->getType()) {
            return BlockTemplateResolverInterface::HTML_BLOCK_TEMPLATE;
        }

        if (BlockInterface::IMAGE_BLOCK_TYPE === $block->getType()) {
            return BlockTemplateResolverInterface::IMAGE_BLOCK_TEMPLATE;
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

        throw new NotFoundResourceException();
    }
}
