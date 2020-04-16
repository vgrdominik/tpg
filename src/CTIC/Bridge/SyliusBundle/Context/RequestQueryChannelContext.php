<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Context;

use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Webmozart\Assert\Assert;

class RequestQueryChannelContext implements ChannelContextInterface
{
    private $channelRepository;
    private $requestStack;

    public function __construct(ChannelRepositoryInterface $channelRepository, RequestStack $requestStack)
    {
        $this->channelRepository = $channelRepository;
        $this->requestStack = $requestStack;
    }

    public function getChannel(): ChannelInterface
    {
        $request = $this->requestStack->getMasterRequest();

        Assert::notNull($request);

        if (!$this->isPathValid($request)) {
            throw new ChannelNotFoundException('Channel not found!');
        }

        try {
            $channelCode = $request->query->get('channelCode');
            Assert::notNull($channelCode);

            $channel = $this->channelRepository->findOneByCode($channelCode);

            if (!$channel instanceof ChannelInterface) {
                throw new \Sylius\ShopApiPlugin\Exception\ChannelNotFoundException('Channel Not Found!');
            }

            return $channel;
        } catch (\Sylius\ShopApiPlugin\Exception\ChannelNotFoundException $e) {
            throw new \Sylius\ShopApiPlugin\Exception\ChannelNotFoundException($e->getMessage());
        } catch (\Exception $e) {
            throw new ChannelNotFoundException('Channel not found!');
        }
    }

    private function isPathValid(Request $request): bool
    {
        $path = $request->getPathInfo();

        if (strpos($path, 'shop-api') !== false) {
            return true;
        }

        return false;
    }
}
