<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use BitBag\SyliusCmsPlugin\Form\Type\FrequentlyAskedQuestionType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class FrequentlyAskedQuestionTypeExtension extends AbstractTypeExtension
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
        return FrequentlyAskedQuestionType::class;
    }
}