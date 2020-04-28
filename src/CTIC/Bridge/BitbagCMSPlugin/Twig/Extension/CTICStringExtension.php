<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Twig\Extension;

use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingInterface;

final class CTICStringExtension extends \Twig_Extension
{
    /**
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('ctic_string_max', [$this, 'renderStringMax'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    /**
     * @param \Twig_Environment $twigEnvironment
     * @param string $text
     * @param int $count
     *
     * @return string
     *
     */
    public function renderStringMax(\Twig_Environment $twigEnvironment, $text, $count): string
    {
        if (! $text) {
            return '';
        }

        if (strlen($text) > $count) {
            return substr($text, 0, $count) . '...';
        }

        return $text;
    }
}
