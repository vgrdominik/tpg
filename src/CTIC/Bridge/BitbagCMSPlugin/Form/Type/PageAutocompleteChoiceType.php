<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\ResourceAutocompleteChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class PageAutocompleteChoiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'resource' => 'bitbag_sylius_cms_plugin.page',
            'choice_name' => 'name',
            'choice_value' => 'id',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['remote_criteria_type'] = 'contains';
        $view->vars['remote_criteria_name'] = 'phrase';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'bitbag_sylius_cms_plugin_page_autocomplete_choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return ResourceAutocompleteChoiceType::class;
    }
}
