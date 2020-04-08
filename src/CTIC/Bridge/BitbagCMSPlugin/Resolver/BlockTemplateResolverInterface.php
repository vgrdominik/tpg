<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Resolver;

use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;

interface BlockTemplateResolverInterface
{
    const TEXT_BLOCK_TEMPLATE = '@BitBagCmsPlugin/Shop/Block/show.html.twig';
    const HTML_BLOCK_TEMPLATE = '@BitBagCmsPlugin/Shop/Block/show.html.twig';
    const IMAGE_BLOCK_TEMPLATE = '@BitBagCmsPlugin/Shop/Block/show.html.twig';
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
