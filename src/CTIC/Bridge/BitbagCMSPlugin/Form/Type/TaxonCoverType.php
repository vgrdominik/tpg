<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType as BaseImageType;

final class TaxonCoverType extends BaseImageType
{
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bitbag_cms_plugin_taxon_cover';
    }
}
