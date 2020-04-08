<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use BitBag\SyliusCmsPlugin\Entity\Block;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class LandingElement implements LandingElementInterface
{
    use ToggleableTrait;
    use TimestampableTrait;
    use BlockableTrait;

    public function __construct()
    {
        $this->initializeChildrenCollection();
    }

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var bool
     */
    protected $isContainer = false;

    /**
     * @var Collection|LandingElementInterface[]
     */
    protected $children;

    /**
     * @var Collection|LandingElementInterface[]
     */
    public $tmpChildren = array();

    /**
     * @var integer
     */
    protected $position = 0;

    /**
     * @var integer
     */
    protected $columns = 1;

    /**
     * @var Landing
     */
    protected $landing;

    /**
     * @var LandingElement|null
     */
    protected $parent;

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isContainer(): bool
    {
        return $this->isContainer;
    }

    /**
     * @param bool $isContainer
     */
    public function setIsContainer(?bool $isContainer): void
    {
        $this->isContainer = (bool) $isContainer;
    }

    /**
     * @return void
     */
    public function initializeChildrenCollection(): void
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @return Collection|LandingElementInterface[]
     */
    public function getChildren(): ?Collection
    {
        return $this->children;
    }

    /**
     * @param Collection|LandingElementInterface[]
     */
    public function setChildren($childrens): void
    {
        $this->initializeChildrenCollection();
        foreach($childrens as $children)
        {
            $this->addChildren($children);
        }
    }

    /**
     * @param LandingElementInterface $landingElment
     *
     * @return bool
     */
    public function hasChildren(LandingElementInterface $landingElment): bool
    {
        return $this->children->contains($landingElment);
    }

    /**
     * @param LandingElementInterface $landingElment
     */
    public function addChildren(LandingElementInterface $landingElment): void
    {
        $this->children->add($landingElment);
    }

    /**
     * @param LandingElementInterface $landingElment
     */
    public function removeChildren(LandingElementInterface $landingElment): void
    {
        if (true === $this->hasChildren($landingElment)) {
            $this->children->removeElement($landingElment);
        }
    }

    /**
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getColumns(): ?int
    {
        return $this->columns;
    }

    /**
     * @param int $columns
     */
    public function setColumns(?int $columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @return Landing
     */
    public function getLanding()
    {
        return $this->landing;
    }

    /**
     * @param LandingInterface $landing
     */
    public function setLanding(LandingInterface $landing = null): void
    {
        $this->landing = $landing;
    }

    /**
     * @return LandingElement|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param LandingElementInterface|null $Parent
     */
    public function setParent(LandingElementInterface $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return boolean
     */
    public function sortElementsCallback(LandingElementInterface $elementA, LandingElementInterface $elementB): int
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
        $elements = $this->getChildren()->toArray();
        uasort($elements, array($this, 'sortElementsCallback'));

        $this->setChildren($elements);

        $landingElements = $this->getChildren();
        /** @var LandingElementInterface $landingElement */
        foreach($landingElements as $landingElement){
            $landingELementBlock = $landingElement->getBlock();
            if(!empty($landingELementBlock) && $landingELementBlock->getType() == BlockSliderInterface::SLIDER_BLOCK_TYPE)
            {
                /** @var BlockTranslationInterface $landingElementBlockTranslation */
                $landingElementBlockTranslation = $landingELementBlock->getTranslation();
                $landingElementBlockSlider = $landingElementBlockTranslation->getSlider();

                if(empty($landingElementBlockSlider))
                {
                    continue;
                }

                $landingElementBlockSlider->orderElements();
            }
        }
    }
}
