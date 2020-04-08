<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use CTIC\Bridge\BitbagCMSPlugin\Form\Type\BlockAutocompleteChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final class LandingElementContainerType extends AbstractResourceType
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
            ->add('isContainer', HiddenType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.is_container',
                'data' => '0'
            ])
            ->add('block', BlockAutocompleteChoiceType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.block',
                'multiple' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getLandingPrefix(): string
    {
        return 'ctic_bridge_bitbag_cms_plugin_landingelement';
    }
}
