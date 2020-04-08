<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;

interface BlockSliderInterface extends
    ResourceInterface
{
    const SLIDER_BLOCK_TYPE = 'slider';

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void;

    /**
     * @return bool
     */
    public function isAccessibility(): ?bool;

    /**
     * @param bool $accessibility
     */
    public function setAccessibility(bool $accessibility): void;

    /**
     * @return bool
     */
    public function isAdaptiveHeight(): ?bool;

    /**
     * @param bool $adaptiveHeight
     */
    public function setAdaptiveHeight(bool $adaptiveHeight): void;

    /**
     * @return bool
     */
    public function isAutoplay(): ?bool;

    /**
     * @param bool $autoplay
     */
    public function setAutoplay(bool $autoplay): void;

    /**
     * @return int
     */
    public function getAutoplaySpeed(): ?int;

    /**
     * @param int $autoplaySpeed
     */
    public function setAutoplaySpeed(int $autoplaySpeed): void;

    /**
     * @return bool
     */
    public function isArrows(): ?bool;

    /**
     * @param bool $arrows
     */
    public function setArrows(bool $arrows): void;

    /**
     * @return bool
     */
    public function isCenterMode(): ?bool;

    /**
     * @param bool $centerMode
     */
    public function setCenterMode(bool $centerMode): void;

    /**
     * @return string
     */
    public function getCenterPadding(): ?string;

    /**
     * @param string $centerPadding
     */
    public function setCenterPadding(string $centerPadding): void;

    /**
     * @return bool
     */
    public function isDots(): ?bool;

    /**
     * @param bool $dots
     */
    public function setDots(bool $dots): void;

    /**
     * @return bool
     */
    public function isDraggable(): ?bool;

    /**
     * @param bool $draggable
     */
    public function setDraggable(bool $draggable): void;

    /**
     * @return bool
     */
    public function isFade(): ?bool;

    /**
     * @param bool $fade
     */
    public function setFade(bool $fade): void;

    /**
     * @return bool
     */
    public function isInfinite(): ?bool;

    /**
     * @param bool $infinite
     */
    public function setInfinite(bool $infinite): void;

    /**
     * @return bool
     */
    public function isPauseOnFocus(): ?bool;

    /**
     * @param bool $pauseOnFocus
     */
    public function setPauseOnFocus(bool $pauseOnFocus): void;

    /**
     * @return bool
     */
    public function isPauseOnHover(): ?bool;

    /**
     * @param bool $pauseOnHover
     */
    public function setPauseOnHover(bool $pauseOnHover): void;

    /**
     * @return bool
     */
    public function isPauseOnDotsHover(): ?bool;

    /**
     * @param bool $pauseOnDotsHover
     */
    public function setPauseOnDotsHover(bool $pauseOnDotsHover): void;

    /**
     * @return int
     */
    public function getRows(): ?int;

    /**
     * @param int $rows
     */
    public function setRows(int $rows): void;

    /**
     * @return int
     */
    public function getSlidesPerRow(): ?int;

    /**
     * @param int $slidesPerRow
     */
    public function setSlidesPerRow(int $slidesPerRow): void;

    /**
     * @return int
     */
    public function getSlidesToShow(): ?int;

    /**
     * @param int $slidesToShow
     */
    public function setSlidesToShow(int $slidesToShow): void;

    /**
     * @return int
     */
    public function getSlidesToScroll(): ?int;

    /**
     * @param int $slidesToScroll
     */
    public function setSlidesToScroll(int $slidesToScroll): void;

    /**
     * @return int
     */
    public function getSpeed(): ?int;

    /**
     * @param int $speed
     */
    public function setSpeed(int $speed): void;

    /**
     * @return bool
     */
    public function isSwipe(): ?bool;

    /**
     * @param bool $swipe
     */
    public function setSwipe(bool $swipe): void;

    /**
     * @return bool
     */
    public function isSwipeToSlide(): ?bool;

    /**
     * @param bool $swipeToSlide
     */
    public function setSwipeToSlide(bool $swipeToSlide): void;

    /**
     * @return bool
     */
    public function isTouchMove(): ?bool;

    /**
     * @param bool $touchMove
     */
    public function setTouchMove(bool $touchMove): void;

    /**
     * @return bool
     */
    public function isVariableWidth(): ?bool;

    /**
     * @param bool $variableWidth
     */
    public function setVariableWidth(bool $variableWidth): void;

    /**
     * @return bool
     */
    public function isVertical(): ?bool;

    /**
     * @param bool $vertical
     */
    public function setVertical(bool $vertical): void;

    /**
     * @return bool
     */
    public function isVerticalSwiping(): ?bool;

    /**
     * @param bool $verticalSwiping
     */
    public function setVerticalSwiping(bool $verticalSwiping): void;

    /**
     * @return bool
     */
    public function isRtl(): ?bool;

    /**
     * @param bool $rtl
     */
    public function setRtl(bool $rtl): void;

    /**
     * @return bool
     */
    public function isWaitForAnimate(): ?bool;

    /**
     * @param bool $waitForAnimate
     */
    public function setWaitForAnimate(bool $waitForAnimate): void;

    /**
     * @return BlockTranslationInterface
     */
    public function getSlideOwner();

    /**
     * @param BlockTranslationInterface|null
     */
    public function setSlideOwner(BlockTranslationInterface $owner): void;

    /**
     * @return void
     */
    public function initializeElementsCollection(): void;

    /**
     * @return Collection|BlockSliderElementInterface[]
     */
    public function getElements(): ?Collection;

    /**
     * @param Collection|BlockSliderElementInterface[]
     */
    public function setElements($elements): void;

    /**
     * @param BlockSliderElementInterface $landingElment
     *
     * @return bool
     */
    public function hasElements(BlockSliderElementInterface $landingElment): ?bool;

    /**
     * @param BlockSliderElementInterface $landingElment
     */
    public function addElements(BlockSliderElementInterface $landingElment): void;

    /**
     * @param BlockSliderElementInterface $landingElment
     */
    public function removeElements(BlockSliderElementInterface $landingElment): void;

    /**
     * @return boolean
     */
    public function sortElementsCallback(BlockSliderElementInterface $elementA, BlockSliderElementInterface $elementB): ?int;

    /**
     * @return void
     */
    public function orderElements(): void;
}
