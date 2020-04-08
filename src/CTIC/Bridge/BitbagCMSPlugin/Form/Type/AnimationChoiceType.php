<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AnimationChoiceType extends AbstractType
{
    protected $animations = [
         'Bounce' => 'bounce',
         'Flash' => 'flash',
         'Pulse' => 'pulse',
         'Rubber Band' => 'rubberBand',
         'Shake' => 'shake',
         'Head Shake' => 'headShake',
         'Swing' => 'swing',
         'Tada' => 'tada',
         'Wobble' => 'wobble',
         'Jello' => 'jello',
         'Bounce In' => 'bounceIn',
         'Bounce In Down' => 'bounceInDown',
         'Bounce In Left' => 'bounceInLeft',
         'Bounce In Right' => 'bounceInRight',
         'Bounce In Up' => 'bounceInUp',
         'Bounce Out' => 'bounceOut',
         'Bounce Out Down' => 'bounceOutDown',
         'Bounce Out Left' => 'bounceOutLeft',
         'Bounce Out Right' => 'bounceOutRight',
         'Bounce Out Up' => 'bounceOutUp',
         'Fade In' => 'fadeIn',
         'Fade In Down' => 'fadeInDown',
         'Fade In Down Big' => 'fadeInDownBig',
         'Fade In Left' => 'fadeInLeft',
         'Fade In Left Big' => 'fadeInLeftBig',
         'Fade In Right' => 'fadeInRight',
         'Fade In Right Big' => 'fadeInRightBig',
         'Fade In Up' => 'fadeInUp',
         'Fade In Up Big' => 'fadeInUpBig',
         'Fade Out' => 'fadeOut',
         'Fade Out Down' => 'fadeOutDown',
         'Fade Out Down Big' => 'fadeOutDownBig',
         'Fade Out Left' => 'fadeOutLeft',
         'Fade Out Left Big' => 'fadeOutLeftBig',
         'Fade Out Right' => 'fadeOutRight',
         'Fade Out Right Big' => 'fadeOutRightBig',
         'Fade Out Up' => 'fadeOutUp',
         'Fade Out Up Big' => 'fadeOutUpBig',
         'Flip' => 'flip',
         'Flip In X' => 'flipInX',
         'Flip In Y' => 'flipInY',
         'Flip Out X' => 'flipOutX',
         'Flip Out Y' => 'flipOutY',
         'Light Speed In' => 'lightSpeedIn',
         'Light Speed Out' => 'lightSpeedOut',
         'Rotate In' => 'rotateIn',
         'Rotate In Down Left' => 'rotateInDownLeft',
         'Rotate In Down Right' => 'rotateInDownRight',
         'Rotate In Up Left' => 'rotateInUpLeft',
         'Rotate In Up Right' => 'rotateInUpRight',
         'Rotate Out' => 'rotateOut',
         'Rotate Out Down Left' => 'rotateOutDownLeft',
         'Rotate Out Down Right' => 'rotateOutDownRight',
         'Rotate Out Up Left' => 'rotateOutUpLeft',
         'Rotate Out Up Right' => 'rotateOutUpRight',
         'Hinge' => 'hinge',
         'Jack In The Box' => 'jackInTheBox',
         'Roll In' => 'rollIn',
         'Roll Out' => 'rollOut',
         'Zoom In' => 'zoomIn',
         'Zoom In Down' => 'zoomInDown',
         'Zoom In Left' => 'zoomInLeft',
         'Zoom In Right' => 'zoomInRight',
         'Zoom In Up' => 'zoomInUp',
         'Zoom Out' => 'zoomOut',
         'Zoom Out Down' => 'zoomOutDown',
         'Zoom Out Left' => 'zoomOutLeft',
         'Zoom Out Right' => 'zoomOutRight',
         'Zoom Out Up' => 'zoomOutUp',
         'Slide In Down' => 'slideInDown',
         'Slide In Left' => 'slideInLeft',
         'Slide In Right' => 'slideInRight',
         'Slide In Up' => 'slideInUp',
         'Slide Out Down' => 'slideOutDown',
         'Slide Out Left' => 'slideOutLeft',
         'Slide Out Right' => 'slideOutRight',
         'Slide Out Up' => 'slideOutUp'
    ];

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choices' => $this->animations,
                'choice_translation_domain' => false,
                'enabled' => true,
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.animationchoice',
                'placeholder' => 'ctic_bridge_bitbag_cms_plugin.ui.select',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return ChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'ctic_bridge_bitbagcmsplugin_animation_choice';
    }
}
