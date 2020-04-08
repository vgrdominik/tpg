<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type\Translation;

use Symfony\Component\Form\AbstractTypeExtension;
use BitBag\SyliusCmsPlugin\Form\Type\Translation\HtmlBlockTranslationType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CTICHtmlBlockTranslationType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.name',
                'required' => false,
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.content'
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return HtmlBlockTranslationType::class;
    }
}
