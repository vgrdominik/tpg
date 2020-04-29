<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Twig\Extension;

use CTIC\Bridge\BitbagCMSPlugin\Repository\BlockRepositoryInterface;
use CTIC\Bridge\BitbagCMSPlugin\Resolver\BlockResourceResolverInterface;
use CTIC\Bridge\BitbagCMSPlugin\Resolver\BlockTemplateResolverInterface;
use Symfony\Component\Templating\EngineInterface;

class RenderBlockExtension extends \Twig_Extension
{
    /** @var BlockRepositoryInterface */
    private $blockRepository;

    /** @var BlockResourceResolverInterface */
    private $blockResourceResolver;

    /** @var BlockTemplateResolverInterface */
    private $blockTemplateResolver;

    /** @var EngineInterface */
    private $templatingEngine;

    public function __construct(
        BlockRepositoryInterface $blockRepository,
        BlockResourceResolverInterface $blockResourceResolver,
        BlockTemplateResolverInterface $blockTemplateResolver,
        EngineInterface $templatingEngine
    ) {
        $this->blockRepository = $blockRepository;
        $this->blockResourceResolver = $blockResourceResolver;
        $this->blockTemplateResolver = $blockTemplateResolver;
        $this->templatingEngine = $templatingEngine;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_Function('bitbag_cms_render_block', [$this, 'renderBlock'], ['is_safe' => ['html']]),
        ];
    }

    public function renderBlock(string $code, ?string $template = null): string
    {
        $block = $this->blockResourceResolver->findOrLog($code);

        if (null !== $block) {
            $template = $template ?? $this->blockTemplateResolver->resolveTemplate($block);

            return $this->templatingEngine->render($template, ['block' => $block]);
        }

        return '';
    }
}
