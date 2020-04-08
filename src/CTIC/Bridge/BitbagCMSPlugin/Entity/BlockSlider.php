<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class BlockSlider implements BlockSliderInterface
{
    /**
     * @var int|null
     */
    protected $id;

    /**
    * @var bool
    */
    protected $accessibility;

    /**
    * @var bool
    */
    protected $adaptiveHeight;

    /**
    * @var bool
    */
    protected $autoplay;

    /**
    * @var int
    */
    protected $autoplaySpeed;

    /**
    * @var bool
    */
    protected $arrows;

    /**
    * @var bool
    */
    protected $centerMode;

    /**
    * @var string
    */
    protected $centerPadding;

    /**
    * @var bool
    */
    protected $dots;

    /**
    * @var bool
    */
    protected $draggable;

    /**
    * @var bool
    */
    protected $fade;

    /**
    * @var bool
    */
    protected $infinite;

    /**
    * @var bool
    */
    protected $pauseOnFocus;

    /**
    * @var bool
    */
    protected $pauseOnHover;

    /**
    * @var bool
    */
    protected $pauseOnDotsHover;

    /**
    * @var int
    */
    protected $rows;

    /**
    * @var int
    */
    protected $slidesPerRow;

    /**
    * @var int
    */
    protected $slidesToShow;

    /**
    * @var int
    */
    protected $slidesToScroll;

    /**
    * @var int
    */
    protected $speed;

    /**
    * @var bool
    */
    protected $swipe;

    /**
    * @var bool
    */
    protected $swipeToSlide;

    /**
    * @var bool
    */
    protected $touchMove;

    /**
    * @var bool
    */
    protected $variableWidth;

    /**
    * @var bool
    */
    protected $vertical;

    /**
    * @var bool
    */
    protected $verticalSwiping;

    /**
    * @var bool
    */
    protected $rtl;

    /**
    * @var bool
    */
    protected $waitForAnimate;

    /**
     * @var BlockTranslationInterface
     */
    protected $slideOwner;

    /**
     * @var Collection|BlockSliderElementInterface[]
     */
    protected $elements = '';

    /**
     * @var Collection|BlockSliderElementInterface[]
     */
    public $tmpElements = array();

    public function __construct()
    {
        $this->initializeElementsCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isAccessibility(): ?bool
    {
        return $this->accessibility;
    }

    /**
     * @param bool $accessibility
     */
    public function setAccessibility(bool $accessibility): void
    {
        $this->accessibility = $accessibility;
    }

    /**
     * @return bool
     */
    public function isAdaptiveHeight(): ?bool
    {
        return $this->adaptiveHeight;
    }

    /**
     * @param bool $adaptiveHeight
     */
    public function setAdaptiveHeight(bool $adaptiveHeight): void
    {
        $this->adaptiveHeight = $adaptiveHeight;
    }

    /**
     * @return bool
     */
    public function isAutoplay(): ?bool
    {
        return $this->autoplay;
    }

    /**
     * @param bool $autoplay
     */
    public function setAutoplay(bool $autoplay): void
    {
        $this->autoplay = $autoplay;
    }

    /**
     * @return int
     */
    public function getAutoplaySpeed(): ?int
    {
        return $this->autoplaySpeed;
    }

    /**
     * @param int $autoplaySpeed
     */
    public function setAutoplaySpeed(int $autoplaySpeed): void
    {
        $this->autoplaySpeed = $autoplaySpeed;
    }

    /**
     * @return bool
     */
    public function isArrows(): ?bool
    {
        return $this->arrows;
    }

    /**
     * @param bool $arrows
     */
    public function setArrows(bool $arrows): void
    {
        $this->arrows = $arrows;
    }

    /**
     * @return bool
     */
    public function isCenterMode(): ?bool
    {
        return $this->centerMode;
    }

    /**
     * @param bool $centerMode
     */
    public function setCenterMode(bool $centerMode): void
    {
        $this->centerMode = $centerMode;
    }

    /**
     * @return string
     */
    public function getCenterPadding(): ?string
    {
        return $this->centerPadding;
    }

    /**
     * @param string $centerPadding
     */
    public function setCenterPadding(string $centerPadding): void
    {
        $this->centerPadding = $centerPadding;
    }

    /**
     * @return bool
     */
    public function isDots(): ?bool
    {
        return $this->dots;
    }

    /**
     * @param bool $dots
     */
    public function setDots(bool $dots): void
    {
        $this->dots = $dots;
    }

    /**
     * @return bool
     */
    public function isDraggable(): ?bool
    {
        return $this->draggable;
    }

    /**
     * @param bool $draggable
     */
    public function setDraggable(bool $draggable): void
    {
        $this->draggable = $draggable;
    }

    /**
     * @return bool
     */
    public function isFade(): ?bool
    {
        return $this->fade;
    }

    /**
     * @param bool $fade
     */
    public function setFade(bool $fade): void
    {
        $this->fade = $fade;
    }

    /**
     * @return bool
     */
    public function isInfinite(): ?bool
    {
        return $this->infinite;
    }

    /**
     * @param bool $infinite
     */
    public function setInfinite(bool $infinite): void
    {
        $this->infinite = $infinite;
    }

    /**
     * @return bool
     */
    public function isPauseOnFocus(): ?bool
    {
        return $this->pauseOnFocus;
    }

    /**
     * @param bool $pauseOnFocus
     */
    public function setPauseOnFocus(bool $pauseOnFocus): void
    {
        $this->pauseOnFocus = $pauseOnFocus;
    }

    /**
     * @return bool
     */
    public function isPauseOnHover(): ?bool
    {
        return $this->pauseOnHover;
    }

    /**
     * @param bool $pauseOnHover
     */
    public function setPauseOnHover(bool $pauseOnHover): void
    {
        $this->pauseOnHover = $pauseOnHover;
    }

    /**
     * @return bool
     */
    public function isPauseOnDotsHover(): ?bool
    {
        return $this->pauseOnDotsHover;
    }

    /**
     * @param bool $pauseOnDotsHover
     */
    public function setPauseOnDotsHover(bool $pauseOnDotsHover): void
    {
        $this->pauseOnDotsHover = $pauseOnDotsHover;
    }

    /**
     * @return int
     */
    public function getRows(): ?int
    {
        return $this->rows;
    }

    /**
     * @param int $rows
     */
    public function setRows(int $rows): void
    {
        $this->rows = $rows;
    }

    /**
     * @return int
     */
    public function getSlidesPerRow(): ?int
    {
        return $this->slidesPerRow;
    }

    /**
     * @param int $slidesPerRow
     */
    public function setSlidesPerRow(int $slidesPerRow): void
    {
        $this->slidesPerRow = $slidesPerRow;
    }

    /**
     * @return int
     */
    public function getSlidesToShow(): ?int
    {
        return $this->slidesToShow;
    }

    /**
     * @param int $slidesToShow
     */
    public function setSlidesToShow(int $slidesToShow): void
    {
        $this->slidesToShow = $slidesToShow;
    }

    /**
     * @return int
     */
    public function getSlidesToScroll(): ?int
    {
        return $this->slidesToScroll;
    }

    /**
     * @param int $slidesToScroll
     */
    public function setSlidesToScroll(int $slidesToScroll): void
    {
        $this->slidesToScroll = $slidesToScroll;
    }

    /**
     * @return int
     */
    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     */
    public function setSpeed(int $speed): void
    {
        $this->speed = $speed;
    }

    /**
     * @return bool
     */
    public function isSwipe(): ?bool
    {
        return $this->swipe;
    }

    /**
     * @param bool $swipe
     */
    public function setSwipe(bool $swipe): void
    {
        $this->swipe = $swipe;
    }

    /**
     * @return bool
     */
    public function isSwipeToSlide(): ?bool
    {
        return $this->swipeToSlide;
    }

    /**
     * @param bool $swipeToSlide
     */
    public function setSwipeToSlide(bool $swipeToSlide): void
    {
        $this->swipeToSlide = $swipeToSlide;
    }

    /**
     * @return bool
     */
    public function isTouchMove(): ?bool
    {
        return $this->touchMove;
    }

    /**
     * @param bool $touchMove
     */
    public function setTouchMove(bool $touchMove): void
    {
        $this->touchMove = $touchMove;
    }

    /**
     * @return bool
     */
    public function isVariableWidth(): ?bool
    {
        return $this->variableWidth;
    }

    /**
     * @param bool $variableWidth
     */
    public function setVariableWidth(bool $variableWidth): void
    {
        $this->variableWidth = $variableWidth;
    }

    /**
     * @return bool
     */
    public function isVertical(): ?bool
    {
        return $this->vertical;
    }

    /**
     * @param bool $vertical
     */
    public function setVertical(bool $vertical): void
    {
        $this->vertical = $vertical;
    }

    /**
     * @return bool
     */
    public function isVerticalSwiping(): ?bool
    {
        return $this->verticalSwiping;
    }

    /**
     * @param bool $verticalSwiping
     */
    public function setVerticalSwiping(bool $verticalSwiping): void
    {
        $this->verticalSwiping = $verticalSwiping;
    }

    /**
     * @return bool
     */
    public function isRtl(): ?bool
    {
        return $this->rtl;
    }

    /**
     * @param bool $rtl
     */
    public function setRtl(bool $rtl): void
    {
        $this->rtl = $rtl;
    }

    /**
     * @return bool
     */
    public function isWaitForAnimate(): ?bool
    {
        return $this->waitForAnimate;
    }

    /**
     * @param bool $waitForAnimate
     */
    public function setWaitForAnimate(bool $waitForAnimate): void
    {
        $this->waitForAnimate = $waitForAnimate;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlideOwner()
    {
        return $this->slideOwner;
    }

    /**
     * {@inheritdoc}
     */
    public function setSlideOwner(BlockTranslationInterface $slideOwner): void
    {
        $this->slideOwner = $slideOwner;
    }

    /**
     * @return void
     */
    public function initializeElementsCollection(): void
    {
        $this->elements = new ArrayCollection();
    }

    /**
     * @return Collection|BlockSliderElementInterface[]
     */
    public function getElements(): ?Collection
    {
        return $this->elements;
    }

    /**
     * @param Collection|BlockSliderElementInterface[]
     */
    public function setElements($elements): void
    {
        $this->initializeElementsCollection();
        foreach($elements as $children)
        {
            $this->addElements($children);
        }
    }

    /**
     * @param BlockSliderElementInterface $landingElment
     *
     * @return bool
     */
    public function hasElements(BlockSliderElementInterface $landingElment): ?bool
    {
        return $this->elements->contains($landingElment);
    }

    /**
     * @param BlockSliderElementInterface $landingElment
     */
    public function addElements(BlockSliderElementInterface $landingElment): void
    {
        $this->elements->add($landingElment);
    }

    /**
     * @param BlockSliderElementInterface $landingElment
     */
    public function removeElements(BlockSliderElementInterface $landingElment): void
    {
        if (true === $this->hasElements($landingElment)) {
            $this->elements->removeElement($landingElment);
        }
    }

    /**
     * @return boolean
     */
    public function sortElementsCallback(BlockSliderElementInterface $elementA, BlockSliderElementInterface $elementB): ?int
    {
        $positionElementA = $elementA->getPosition();
        $positionElementB = $elementB->getPosition();

        if($positionElementA == $positionElementB) {
            return 0;
        }

        return ($positionElementA < $positionElementB) ? -1 : 1;
    }

    /**
     * @return void
     */
    public function orderElements(): void
    {
        $elements = $this->getElements()->toArray();
        uasort($elements, array($this, 'sortElementsCallback'));

        $this->setElements($elements);
    }
}
