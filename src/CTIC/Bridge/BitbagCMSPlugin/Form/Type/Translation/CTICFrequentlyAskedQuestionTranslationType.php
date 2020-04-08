<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type\Translation;

use Symfony\Component\Form\AbstractTypeExtension;
use BitBag\SyliusCmsPlugin\Form\Type\Translation\FrequentlyAskedQuestionTranslationType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CTICFrequentlyAskedQuestionTranslationType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.question',
            ])
            ->add('answer', CKEditorType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.answer',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return FrequentlyAskedQuestionTranslationType::class;
    }
}
