<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use CTIC\Bridge\BitbagCMSPlugin\Form\Type\LandingAutocompleteChoiceType;
use Doctrine\ORM\EntityRepository;
use Sylius\Bundle\ChannelBundle\Doctrine\ORM\ChannelRepository;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Channel\Model\Channel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

final class HomeType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('landing', LandingAutocompleteChoiceType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.landing',
                'multiple' => false,
            ])
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
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.enabled',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bridge_bitbag_block_home';
    }
}
