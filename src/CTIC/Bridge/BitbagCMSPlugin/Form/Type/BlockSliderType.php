<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class BlockSliderType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('accessibility', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.accessibility',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.accessibility_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('adaptiveHeight', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.adaptive_height',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.adaptive_height_help'
                )
            ])
            ->add('autoplay', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.autoplay',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.autoplay_help'
                )
            ])
            ->add('autoplaySpeed', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.autoplay_speed',
                'empty_data' => '3000',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.autoplay_speed_help'
                )
            ])
            ->add('arrows', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.arrows',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.arrows_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('centerMode', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.center_mode',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.center_mode_help'
                )
            ])
            ->add('centerPadding', TextType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.center_padding',
                'empty_data' => '50px',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.center_padding_help'
                )
            ])
            ->add('dots', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.dots',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.dots_help'
                )
            ])
            ->add('draggable', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.draggable',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.draggable_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('fade', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.fade',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.fade_help'
                )
            ])
            ->add('infinite', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.infinite',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.infinite_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('pauseOnFocus', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.pause_on_focus',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.pause_on_focus_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('pauseOnHover', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.pause_on_hover',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.pause_on_hover_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('pauseOnDotsHover', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.pause_on_dots_hover',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.pause_on_dots_hover_help'
                )
            ])
            ->add('rows', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.rows',
                'empty_data' => '1',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.rows_help'
                )
            ])
            ->add('slidesPerRow', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.slides_per_row',
                'empty_data' => '1',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.slides_per_row_help'
                )
            ])
            ->add('slidesToShow', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.slides_to_show',
                'empty_data' => '1',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.slides_to_show_help'
                )
            ])
            ->add('slidesToScroll', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.slides_to_scroll',
                'empty_data' => '1',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.slides_to_scroll_help'
                )
            ])
            ->add('speed', IntegerType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.speed',
                'empty_data' => '300',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.speed_help'
                )
            ])
            ->add('swipe', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.swipe',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.swipe_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('swipeToSlide', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.swipe_to_slide',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.swipe_to_slide_help'
                )
            ])
            ->add('touchMove', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.touch_move',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.touch_move_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('variableWidth', HiddenType::class, [
                'attr'  => array(
                    'value'   => true
                )
            ])
            ->add('vertical', HiddenType::class, [
                'attr'  => array(
                    'value'   => '0'
                )
            ])
            ->add('verticalSwiping', HiddenType::class, [
                'attr'  => array(
                    'value'   => '0'
                )
            ])
            ->add('rtl', HiddenType::class, [
                'attr'  => array(
                    'value'   => '0'
                )
            ])
            ->add('waitForAnimate', CheckboxType::class, [
                'label' => 'ctic_bridge_bitbag_cms_plugin.ui.slider.wait_for_animate',
                'attr'  => array(
                    'help'  => 'ctic_bridge_bitbag_cms_plugin.ui.slider.wait_for_animate_help',
                    'checked'   => 'checked'
                )
            ])
            ->add('elements', CollectionType::class, array(
                'entry_type'            => BlockSliderElementType::class,
                'label'                 => 'ctic_bridge_bitbag_cms_plugin.ui.slider.blocksliderelement',
                'allow_add'             => true,
                'button_add_label'      => 'ctic_bridge_bitbag_cms_plugin.ui.slider.blocksliderelementadd',
                'allow_delete'          => true,
                'button_delete_label'   => 'ctic_bridge_bitbag_cms_plugin.ui.slider.blocksliderelementdelete'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getSliderPrefix(): string
    {
        return 'ctic_bridge_bitbag_cms_plugin_slider';
    }
}
