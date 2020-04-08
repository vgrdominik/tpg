<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use CTIC\Bridge\BitbagCMSPlugin\Form\Type\BlockAutocompleteChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class LandingElementType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.name'
            ])
            ->add('position', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.position'
            ])
            ->add('columns', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.num_columns'
            ])
            ->add('isContainer', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.is_container',
            ])
            ->add('block', BlockAutocompleteChoiceType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.block',
                'multiple' => false,
            ])
            ->add('children', CollectionType::class, array(
                'entry_type'            => LandingElementContainerType::class,
                'label'                 => 'ctic_bridge_bitbag_cms_plugin.ui.landingelementcointainer',
                'allow_add'             => true,
                'button_add_label'      => 'ctic_bridge_bitbag_cms_plugin.ui.landingelementcointaineradd',
                'allow_delete'          => true,
                'button_delete_label'   => 'ctic_bridge_bitbag_cms_plugin.ui.landingelementcointainerdelete'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bridge_bitbag_block_landingelement';
    }
}
