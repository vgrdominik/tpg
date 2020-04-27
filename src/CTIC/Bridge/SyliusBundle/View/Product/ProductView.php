<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\View\Product;

use Sylius\ShopApiPlugin\View\Product\ProductTaxonView;

class ProductView
{
    /** @var string */
    public $code;

    /** @var string */
    public $name;

    /** @var string */
    public $slug;

    /** @var string */
    public $channelCode;

    /** @var string */
    public $breadcrumb;

    /** @var string */
    public $description;

    /** @var string */
    public $shortDescription;

    /** @var string */
    public $metaKeywords;

    /** @var string */
    public $metaDescription;

    /** @var string */
    public $averageRating;

    /** @var ProductTaxonView */
    public $taxons;

    /** @var float */
    public $taxRateAmount;

    /** @var array */
    public $variants = [];

    /** @var array */
    public $attributes = [];

    /** @var array */
    public $associations = [];

    /** @var array */
    public $images = [];

    public function __construct()
    {
        $this->taxons = new ProductTaxonView();
    }
}
