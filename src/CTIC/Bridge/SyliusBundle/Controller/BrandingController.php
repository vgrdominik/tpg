<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Controller;

use CTIC\Bridge\SyliusBundle\Entity\BrandingInterface;
use CTIC\Bridge\SyliusBundle\Repository\BrandingRepository;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class BrandingController extends ResourceController
{
    /**
     * @var BrandingRepository
     */
    protected $repository;

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function renderBrandingAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::SHOW);

        $channel = $this->container->get('sylius.context.channel')->getChannel();

        /** @var BrandingInterface $branding */
        $branding = $this->repository->findOneBy(array(
            'channel' => $channel,
            'enabled' => true
        ));

        if(!$branding instanceof BrandingInterface)
        {
            throw $this->createNotFoundException();
        }

        return $this->render(
            '@CTICBridgeSyliusBundle/Branding/branding.html.twig',
        );
    }
}
