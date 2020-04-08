<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type\Translation;

use Symfony\Component\Form\AbstractTypeExtension;
use BitBag\SyliusCmsPlugin\Form\Type\PageImageType;
use BitBag\SyliusCmsPlugin\Form\Type\Translation\PageTranslationType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class CTICPageTranslationType extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.name',
            ])
            ->add('slug', TextType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.slug',
            ])
            ->add('metaKeywords', TextareaType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.meta_keywords',
                'required' => false,
            ])
            ->add('metaDescription', TextareaType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.meta_description',
                'required' => false,
            ])
            ->add('content', CKEditorType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.content',
            ])
            ->add('image', PageImageType::class, [
                'label' => false,
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return PageTranslationType::class;
    }
}
