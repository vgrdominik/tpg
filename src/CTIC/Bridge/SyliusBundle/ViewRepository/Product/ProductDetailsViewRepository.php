<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\ViewRepository\Product;

use CTIC\Bridge\SyliusBundle\Factory\Product\ProductViewFactoryInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\ShopApiPlugin\Provider\SupportedLocaleProviderInterface;
use Sylius\ShopApiPlugin\View\Product\ProductView;
use Sylius\ShopApiPlugin\ViewRepository\Product\ProductDetailsViewRepositoryInterface;
use Webmozart\Assert\Assert;

final class ProductDetailsViewRepository implements ProductDetailsViewRepositoryInterface
{
    /** @var ChannelRepositoryInterface */
    private $channelRepository;

    /** @var ProductRepositoryInterface */
    private $productRepository;

    /** @var ProductViewFactoryInterface */
    private $productViewFactory;

    /** @var SupportedLocaleProviderInterface */
    private $supportedLocaleProvider;

    public function __construct(
        ChannelRepositoryInterface $channelRepository,
        ProductRepositoryInterface $productRepository,
        ProductViewFactoryInterface $productViewFactory,
        SupportedLocaleProviderInterface $supportedLocaleProvider
    ) {
        $this->channelRepository = $channelRepository;
        $this->productRepository = $productRepository;
        $this->productViewFactory = $productViewFactory;
        $this->supportedLocaleProvider = $supportedLocaleProvider;
    }

    public function findOneBySlug(string $productSlug, string $channelCode, ?string $localeCode): ProductView
    {
        $channel = $this->getChannel($channelCode);
        $localeCode = $this->supportedLocaleProvider->provide($localeCode, $channel);

        $product = $this->productRepository->findOneByChannelAndSlug($channel, $localeCode, $productSlug);

        Assert::notNull($product, sprintf('Product with slug %s has not been found in %s locale.', $productSlug, $localeCode));

        return $this->productViewFactory->create($product, $channel, $localeCode);
    }

    public function findOneByCode(string $productCode, string $channelCode, ?string $localeCode): ProductView
    {
        $channel = $this->getChannel($channelCode);
        $localeCode = $this->supportedLocaleProvider->provide($localeCode, $channel);

        $product = $this->productRepository->findOneByCode($productCode);

        Assert::notNull($product, sprintf('Product with code %s has not been found.', $productCode));
        Assert::true($product->hasChannel($channel), sprintf('Product with code %s has not been found for channel %s.', $productCode, $channelCode));

        return $this->productViewFactory->create($product, $channel, $localeCode);
    }

    private function getChannel(string $channelCode): ChannelInterface
    {
        /** @var ChannelInterface $channel */
        $channel = $this->channelRepository->findOneByCode($channelCode);

        Assert::notNull($channel, sprintf('Channel with code %s has not been found.', $channelCode));

        return $channel;
    }
}
