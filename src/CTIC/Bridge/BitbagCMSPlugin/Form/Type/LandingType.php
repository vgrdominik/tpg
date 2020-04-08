<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class LandingType extends AbstractResourceType
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
            ->add('elements', CollectionType::class, array(
                'entry_type'            => LandingElementType::class,
                'label'                 => 'ctic_bridge_bitbag_cms_plugin.ui.landingelement',
                'allow_add'             => true,
                'button_add_label'      => 'ctic_bridge_bitbag_cms_plugin.ui.landingelementadd',
                'allow_delete'          => true,
                'button_delete_label'   => 'ctic_bridge_bitbag_cms_plugin.ui.landingelementdelete'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bridge_bitbag_block_landing';
    }
}
