<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface LandingInterface extends
    ResourceInterface,
    TimestampableInterface
{
    /**
     * @return void
     */
    public function initializeElementsCollection(): void;

    /**
     * @return Collection|LandingElementInterface[]
     */
    public function getElements(): ?Collection;

    /**
     * @param LandingElementInterface $landingElment
     *
     * @return bool
     */
    public function hasElements(LandingElementInterface $landingElment): bool;

    /**
     * @param LandingElementInterface $landingElment
     */
    public function addElements(LandingElementInterface $landingElment): void;

    /**
     * @param LandingElementInterface $landingElment
     */
    public function removeElements(LandingElementInterface $landingElment): void;

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return void
     */
    public function orderElements(): void;
}
