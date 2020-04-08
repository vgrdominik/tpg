<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Form\Type;

use BitBag\SyliusCmsPlugin\Entity\BlockInterface as BitBagBlockInterface;
use BitBag\SyliusCmsPlugin\Form\Type\BlockType;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\BlockSliderInterface;
use CTIC\Bridge\BitbagCMSPlugin\Form\Type\Translation\BlockSliderTranslationType;
use CTIC\Bridge\BitbagCMSPlugin\Form\Type\Translation\BlockTaxonTranslationType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Valid;

final class BlockTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var BitBagBlockInterface $block */
        $block = $builder->getData();

        $this->resolveBlockType($block, $builder);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param BitBagBlockInterface $block
     */
    private function resolveBlockType(BitBagBlockInterface $block, FormBuilderInterface $builder): void
    {
        if (BlockSliderInterface::SLIDER_BLOCK_TYPE === $block->getType()) {
            $builder->add('translations', ResourceTranslationsType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.contents',
                'entry_type' => BlockSliderTranslationType::class,
                'validation_groups' => ['bitbag_content'],
                'constraints' => [
                    new Valid(),
                ],
            ]);

            return;
        }else if (BlockInterface::TAXON_BLOCK_TYPE === $block->getType()) {
            $builder->add('translations', ResourceTranslationsType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.contents',
                'entry_type' => BlockTaxonTranslationType::class,
                'validation_groups' => ['bitbag_content'],
                'constraints' => [
                    new Valid(),
                ],
            ]);

            return;
        }else if (BlockInterface::PAGE_BLOCK_TYPE === $block->getType()) {
            $builder->add('translations', ResourceTranslationsType::class, [
                'label' => 'bitbag_sylius_cms_plugin.ui.contents',
                'entry_type' => BlockTaxonTranslationType::class,
                'validation_groups' => ['bitbag_content'],
                'constraints' => [
                    new Valid(),
                ],
            ]);

            return;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType(): string
    {
        return BlockType::class;
    }
}