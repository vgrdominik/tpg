<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class BlockSliderElementType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.name'
            ])
            ->add('position', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.position'
            ])
            ->add('title', TextType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.title'
            ])
            ->add('titleAnimation', AnimationChoiceType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.title_animation'
            ])
            ->add('mainPhrase', TextType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.main_phrase'
            ])
            ->add('mainPhraseAnimation', AnimationChoiceType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.main_phrase_animation'
            ])
            ->add('link', TextType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.link'
            ])
            ->add('linkAnimation', AnimationChoiceType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.link_animation'
            ])
            ->add('linkText', TextType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.link_text'
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => BlockSliderElementImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.image',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.sliderelement.images_help',
                )
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bridge_bitbag_block_blocksliderelement';
    }
}
