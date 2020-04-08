<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\ContentableInterface;
use BitBag\SyliusCmsPlugin\Entity\ProductsAwareInterface;
use BitBag\SyliusCmsPlugin\Entity\SectionableInterface;
use BitBag\SyliusCmsPlugin\Entity\TaxonAwareInterface;
use Sylius\Component\Channel\Model\ChannelsAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface BlockInterface extends
    ResourceInterface,
    TranslatableInterface,
    ToggleableInterface,
    ProductsAwareInterface,
    TaxonAwareInterface,
    SectionableInterface,
    ChannelsAwareInterface,
    ContentableInterface
{
    const TEXT_BLOCK_TYPE = 'text';
    const HTML_BLOCK_TYPE = 'html';
    const IMAGE_BLOCK_TYPE = 'image';
    const TAXON_BLOCK_TYPE = 'taxon';
    const PAGE_BLOCK_TYPE = 'page';

    public function getCode(): ?string;

    public function setCode(?string $code): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getContent(): ?string;

    public function setContent(?string $content): void;

    public function getLink(): ?string;

    public function setLink(?string $link): void;
}
