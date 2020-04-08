<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use CTIC\Bridge\BitbagCMSPlugin\Form\DataTransformer\LandingTransformer;
use Sylius\Bundle\AttributeBundle\Form\Type\AttributeType\Configuration\SelectAttributeValueTranslationsType;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

final class SelectAttributeValueTranslationsTypeExtension extends AbstractTypeExtension
{
    /**
     * @var LandingTransformer
     */
    private $landingTransformer;

    /**
     * @var string[]
     */
    private $definedLocalesCodes;

    /**
     * @var string
     */
    private $defaultLocaleCode;

    /**
     * @param TranslationLocaleProviderInterface $localeProvider
     */
    public function __construct(TranslationLocaleProviderInterface $localeProvider, LandingTransformer $landingTransformer)
    {
        $this->definedLocalesCodes = $localeProvider->getDefinedLocalesCodes();
        $this->defaultLocaleCode = $localeProvider->getDefaultLocaleCode();
        $this->landingTransformer = $landingTransformer;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($options['entries'] as $entry) {
            $entryName = $options['entry_name']($entry);

            $entryOptions = $options['entry_options']($entry);

            $entryType = $options['entry_type']($entry);
            if($entryName == 'landing')
            {
                $entryType = LandingAutocompleteChoiceType::class;
            }

            $builder->add($entryName, $entryType, array_replace(
                [
                    'property_path' => '[' . $entryName . ']',
                    'block_name' => 'entry',
                ],
                $entryOptions)
            );
        }

        $builder->get('landing')
            ->addModelTransformer($this->landingTransformer);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $entries = array('landing');
        $entries = array_merge($entries, $this->definedLocalesCodes);

        $resolver->setDefaults([
            'entries' => $entries,
            'entry_name' => function (string $title): string {
                return $title;
            },
            'entry_options' => function (string $option): array {
                $return = [
                    'required' => $option === $this->defaultLocaleCode,
                ];

                if($option == 'landing')
                {
                    $return['label'] = 'ctic_bridge_bitbag_cms_plugin.ui.landing';
                }

                return $return;
            },
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return SelectAttributeValueTranslationsType::class;
    }
}