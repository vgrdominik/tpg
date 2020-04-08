<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusComponent\Locale\Converter;

use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Converter\LocaleConverterInterface;
use CTIC\Bridge\SymfonyIntlComponent\Intl;
use Webmozart\Assert\Assert;

final class LocaleConverter implements LocaleConverterInterface
{
    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @param LocaleContextInterface $localeContext
     */
    public function __construct(
        LocaleContextInterface $localeContext
    ) {
        $this->localeContext = $localeContext;
    }

    /**
     * {@inheritdoc}
     */
    public function convertNameToCode(string $name, ?string $locale = null): string
    {
        if(empty($locale))
        {
            $locale = $this->localeContext->getLocaleCode();
        }
        $names = Intl::getLocaleBundle()->getLocaleNames($locale ?? 'en');
        $code = array_search($name, $names, true);

        Assert::string($code, sprintf('Cannot find code for "%s" locale name', $name));

        return $code;
    }

    /**
     * {@inheritdoc}
     */
    public function convertCodeToName(string $code, ?string $locale = null): string
    {
        if(empty($locale))
        {
            $locale = $this->localeContext->getLocaleCode();
        }
        $name = Intl::getLocaleBundle()->getLocaleName($code, $locale ?? 'en');

        Assert::string($name, sprintf('Cannot find name for "%s" locale code', $code));

        return $name;
    }
}
