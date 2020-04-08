<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Controller;

use CTIC\Bridge\BitbagCMSPlugin\Entity\HomeInterface;
use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingInterface;
use CTIC\Bridge\BitbagCMSPlugin\Repository\HomeRepository;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HomeController extends ResourceController
{
    /**
     * @var HomeRepository
     */
    protected $repository;

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function renderHomeAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);

        $this->isGrantedOr403($configuration, ResourceActions::SHOW);

        $channel = $this->container->get('sylius.context.channel')->getChannel();

        /** @var HomeInterface $home */
        $home = $this->repository->findOneBy(array(
            'channel' => $channel,
            'enabled' => true
        ));

        if(!$home instanceof HomeInterface || !$home->getLanding() instanceof LandingInterface)
        {
            throw $this->createNotFoundException();
        }

        $landing = $home->getLanding();
        $landing->orderElements();

        return $this->render(
            '@CTICBridgeBitbagCMSPlugin/Landing/landing.html.twig',
            array('landing' => $landing)
        );
    }
}
