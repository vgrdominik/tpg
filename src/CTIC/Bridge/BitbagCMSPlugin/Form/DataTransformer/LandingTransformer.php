<?php
namespace CTIC\Bridge\BitbagCMSPlugin\Form\DataTransformer;

use CTIC\Bridge\BitbagCMSPlugin\Entity\Landing;
use CTIC\Bridge\BitbagCMSPlugin\Entity\LandingInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;

class LandingTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @param  LandingInterface|string|integer|null $landing
     * @return string
     */
    public function transform($landing)
    {
        if (empty($landing) || is_object($landing)) {
            return $landing;
        }

        $landingRepository = $this->entityManager->getRepository(Landing::class);

        return $landingRepository->find($landing);
    }

    /**
     *
     * @param  LandingInterface|string|integer|null $landing
     * @return string|integer|null
     */
    public function reverseTransform($landing)
    {
        if (is_object($landing)) {
            return $landing->getId();
        }

        return $landing;
    }
}