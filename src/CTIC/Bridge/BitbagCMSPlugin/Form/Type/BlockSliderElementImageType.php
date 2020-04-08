<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

final class BlockSliderElementImageType extends ImageType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bridge_bitbag_block_blocksliderelementimage';
    }
}
