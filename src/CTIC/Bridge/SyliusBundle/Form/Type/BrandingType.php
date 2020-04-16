<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Sylius\Bundle\ChannelBundle\Doctrine\ORM\ChannelRepository;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Channel\Model\Channel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;

final class BrandingType extends AbstractResourceType
{
    protected $styleButtons = [
        'Outlined' => 'outlined',
        'Rounded' => 'rounded',
        'Text' => 'text',
    ];
    protected $styleForm = [
        'Outlined' => 'outlined',
        'Box' => 'box',
    ];
    protected $styleCard = [
        'Shaped' => 'shaped',
        'Box' => 'box',
        'Rounded' => 'rounded',
    ];
    protected $styleDialogCard = [
        'Shaped' => 'shaped',
        'Box' => 'box',
        'Rounded' => 'rounded',
    ];

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('channel',  EntityType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.channel',
                'class' => Channel::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('c');
                },
                'choice_label' => 'name'
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.enabled',
            ])
            ->add('colorPrimary', ColorType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.primary_color',
            ])
            ->add('colorSecondary', ColorType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.secondary_color',
            ])
            ->add('colorAccent', ColorType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.accent_color',
            ])
            ->add('colorSuccess', ColorType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.success_color',
            ])
            ->add('colorError', ColorType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.error_color',
            ])
            ->add('colorWarning', ColorType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.warning_color',
            ])
            ->add('colorInfo', ColorType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.info_color',
            ])
            ->add('styleButton', ChoiceType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.style_button',
                'choices' => $this->styleButtons,
                'required' => true,
                'choice_translation_domain' => false,
            ])
            ->add('styleForm', ChoiceType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.style_form',
                'choices' => $this->styleForm,
                'required' => true,
                'choice_translation_domain' => false,
            ])
            ->add('styleCard', ChoiceType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.style_card',
                'choices' => $this->styleCard,
                'required' => true,
                'choice_translation_domain' => false,
            ])
            ->add('styleDialogCard', ChoiceType::class, [
                'label' => 'ctic_bridge_sylius_bundle.ui.style_card_dialog',
                'choices' => $this->styleDialogCard,
                'required' => true,
                'choice_translation_domain' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bridge_sylius_bundle_branding';
    }
}
