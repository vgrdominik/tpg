<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class TaxonTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('cover', TaxonCoverType::class, [
            'label' => 'ctic_bridge_bitbag_cms_plugin.ui.cover'
        ])
        ->add('landing', LandingAutocompleteChoiceType::class, [
            'label' => 'ctic_bridge_bitbag_cms_plugin.ui.landing',
            'multiple' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return TaxonType::class;
    }
}