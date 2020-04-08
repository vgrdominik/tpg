<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Resolver;

use BitBag\SyliusCmsPlugin\Entity\BlockInterface;

interface BlockTemplateResolverInterface
{
    const SLIDER_BLOCK_TEMPLATE = '@CTICBridgeBitbagCMSPlugin/Shop/Block/Show/sliderBlock.html.twig';
    const TAXON_BLOCK_TEMPLATE = '@CTICBridgeBitbagCMSPlugin/Shop/Block/Show/taxonBlock.html.twig';
    const PAGE_BLOCK_TEMPLATE = '@CTICBridgeBitbagCMSPlugin/Shop/Block/Show/pageBlock.html.twig';

    /**
     * @param BlockInterface $block
     *
     * @return string
     */
    public function resolveTemplate(BlockInterface $block): string;
}
