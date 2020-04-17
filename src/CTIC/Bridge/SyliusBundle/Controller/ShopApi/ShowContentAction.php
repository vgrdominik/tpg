<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Controller\ShopApi;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\ShopApiPlugin\Factory\Taxon\TaxonDetailsViewFactoryInterface;
use Sylius\ShopApiPlugin\Http\RequestBasedLocaleProviderInterface;
use Sylius\ShopApiPlugin\Model\PaginatorDetails;
use Sylius\ShopApiPlugin\ViewRepository\Product\ProductCatalogViewRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowContentAction
{
    /** @var RepositoryInterface */
    private $taxonRepository;

    /** @var ProductCatalogViewRepositoryInterface */
    private $productCatalogQuery;

    /** @var RepositoryInterface */
    private $channelRepository;

    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var ChannelContextInterface */
    private $channelContext;

    /** @var TaxonDetailsViewFactoryInterface */
    private $taxonViewFactory;

    /** @var RequestBasedLocaleProviderInterface */
    private $requestBasedLocaleProvider;

    public function __construct(
        RepositoryInterface $taxonRepository,
        ProductCatalogViewRepositoryInterface $productCatalogQuery,
        RepositoryInterface $channelRepository,
        ViewHandlerInterface $viewHandler,
        ChannelContextInterface $channelContext,
        TaxonDetailsViewFactoryInterface $taxonViewFactory,
        RequestBasedLocaleProviderInterface $requestBasedLocaleProvider
    ) {
        $this->taxonRepository = $taxonRepository;
        $this->productCatalogQuery = $productCatalogQuery;
        $this->channelRepository = $channelRepository;
        $this->viewHandler = $viewHandler;
        $this->channelContext = $channelContext;
        $this->taxonViewFactory = $taxonViewFactory;
        $this->requestBasedLocaleProvider = $requestBasedLocaleProvider;
    }

    public function __invoke(Request $request): Response
    {
        try {

            $channel = $this->channelContext->getChannel();
            $mainTaxonByChannel = $this->channelRepository->find($channel->getId())->getMenuTaxon();

            /** @var TaxonInterface|null $taxon */
            $taxon = $this->taxonRepository->findOneBy(['code' => $mainTaxonByChannel->getCode()]);
            $localeCode = $this->requestBasedLocaleProvider->getLocaleCode($request);

            $products = $this->productCatalogQuery->findByTaxonCode(
                $mainTaxonByChannel->getCode(),
                $channel->getCode(),
                new PaginatorDetails($request->attributes->get('_route'), $request->query->all()),
                $request->query->get('locale')
            );

            $response = new View();
            $response->setData([
                'product' => $products,
                'family' => [$this->taxonViewFactory->create($taxon, $localeCode)->self]
            ]);

            return $this->viewHandler->handle(View::create($response, Response::HTTP_OK));
        } catch (ChannelNotFoundException $exception) {
            throw new NotFoundHttpException('Channel has not been found.');
        } catch (\InvalidArgumentException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        }
    }
}
