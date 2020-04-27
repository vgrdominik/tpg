<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Factory\Product;

use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use CTIC\Bridge\SyliusBundle\View\Product\ProductView;

interface ProductViewFactoryInterface
{
    public function create(ProductInterface $product, ChannelInterface $channel, string $locale): ProductView;
}
