<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Doctrine\Common\Collections\Collection;

interface LandingElementInterface extends
    ResourceInterface,
    ToggleableInterface,
    TimestampableInterface,
    BlockableInterface
{

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     */
    public function setName(?string $name): void;

    /**
     * @return bool
     */
    public function isContainer(): bool;

    /**
     * @param bool $isContainer
     */
    public function setIsContainer(?bool $isContainer): void;

    /**
     * @return void
     */
    public function initializeChildrenCollection(): void;

    /**
     * @return Collection|LandingElementInterface[]
     */
    public function getChildren(): ?Collection;

    /**
     * @param LandingElementInterface $landingElment
     *
     * @return bool
     */
    public function hasChildren(LandingElementInterface $landingElment): bool;

    /**
     * @param LandingElementInterface $landingElment
     */
    public function addChildren(LandingElementInterface $landingElment): void;

    /**
     * @param LandingElementInterface $landingElment
     */
    public function removeChildren(LandingElementInterface $landingElment): void;

    /**
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return int
     */
    public function getColumns(): ?int;

    /**
     * @param int $columns
     */
    public function setColumns(?int $columns): void;

    /**
     * @return Landing
     */
    public function getLanding();

    /**
     * @param LandingInterface $landing
     */
    public function setLanding(LandingInterface $landing = null): void;

    /**
     * @return LandingElementInterface|null
     */
    public function getParent();

    /**
     * @param LandingElementInterface|null $parent
     */
    public function setParent(LandingElementInterface $parent): void;

    /**
     * @return void
     */
    public function orderElements(): void;
}
