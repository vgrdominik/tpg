<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Twig\Extension;

final class NumberColumnsExtension extends \Twig_Extension
{
    /**
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('ctic_bitbag_cms_plugin_number_column', [$this, 'getNumberColumnAsString'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    public function getNumberColumnAsString(\Twig_Environment $twigEnvironment, int $columns): string
    {
        $numbers = array(
            'zero',
            '',
            'two',
            'three',
            'four',
            'five',
            'six',
            'seven',
            'eight',
            'nine',
            'ten',
            'eleven',
            'twelve',
            'thirteen',
            'fourteen',
            'fiveteen',
            'sixteen'
        );

        if($columns > 16 || $columns < 0)
        {
            return '';
        }

        return $numbers[$columns];
    }
}
