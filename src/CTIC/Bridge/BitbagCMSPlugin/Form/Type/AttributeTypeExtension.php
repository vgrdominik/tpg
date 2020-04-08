<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Sylius\Bundle\ProductBundle\Form\Type\ProductAttributeType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class AttributeTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('landing', LandingAutocompleteChoiceType::class, [
            'label' => 'ctic_bridge_bitbag_cms_plugin.ui.landing',
            'multiple' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return ProductAttributeType::class;
    }
}