<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Controller\ShopApi;

use CTIC\Bridge\SyliusBundle\Repository\BrandingRepositoryInterface;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowConfigurationAction
{
    /** @var BrandingRepositoryInterface */
    private $brandingRepository;

    /** @var RepositoryInterface */
    private $shopBillingDataRepository;

    /** @var RepositoryInterface */
    private $channelRepository;

    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var ChannelContextInterface */
    private $channelContext;

    public function __construct(
        BrandingRepositoryInterface $brandingRepository,
        RepositoryInterface $shopBillingDataRepository,
        RepositoryInterface $channelRepository,
        ViewHandlerInterface $viewHandler,
        ChannelContextInterface $channelContext
    ) {
        $this->brandingRepository = $brandingRepository;
        $this->channelRepository = $channelRepository;
        $this->viewHandler = $viewHandler;
        $this->channelContext = $channelContext;
    }

    public function __invoke(Request $request): Response
    {
        try {

            $channel = $this->channelContext->getChannel();
            $response = new View();
            $response->setData([
                'tax_identification' => $this->channelRepository->find($channel->getId())->getShopBillingData(),
                'branding' => $this->brandingRepository->findOneByChannel($channel)
            ]);

            return $this->viewHandler->handle(View::create($response, Response::HTTP_OK));
        } catch (ChannelNotFoundException $exception) {
            throw new NotFoundHttpException('Channel has not been found.');
        } catch (\InvalidArgumentException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }
    }
}
