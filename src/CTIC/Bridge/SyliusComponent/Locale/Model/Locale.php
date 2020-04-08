<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusComponent\Locale\Model;

use CTIC\Bridge\SymfonyIntlComponent\Intl;
use Sylius\Component\Locale\Model\Locale as BaseLocale;

class Locale extends BaseLocale
{
    /**
     * {@inheritdoc}
     */
    public function getName(?string $locale = null): ?string
    {
        return Intl::getLocaleBundle()->getLocaleName($this->getCode(), $locale);
    }
}
