<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\TimestampableTrait;

class Landing implements LandingInterface
{
    use TimestampableTrait;

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var Collection|LandingElementInterface[]
     */
    protected $elements = '';

    /**
     * @var Collection|LandingElementInterface[]
     */
    public $tmpElements = array();

    public function __construct()
    {
        $this->initializeElementsCollection();
    }

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
     * @return void
     */
    public function initializeElementsCollection(): void
    {
        $this->elements = new ArrayCollection();
    }

    /**
     * @return Collection|LandingElementInterface[]
     */
    public function getElements(): ?Collection
    {
        return $this->elements;
    }

    /**
     * @param Collection|LandingElementInterface[]
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
     * @param LandingElementInterface $landingElment
     *
     * @return bool
     */
    public function hasElements(LandingElementInterface $landingElment): bool
    {
        return $this->elements->contains($landingElment);
    }

    /**
     * @param LandingElementInterface $landingElment
     */
    public function addElements(LandingElementInterface $landingElment): void
    {
        $this->elements->add($landingElment);
    }

    /**
     * @param LandingElementInterface $landingElment
     */
    public function removeElements(LandingElementInterface $landingElment): void
    {
        if (true === $this->hasElements($landingElment)) {
            $this->elements->removeElement($landingElment);
        }
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
        $elements = $this->getElements()->toArray();
        uasort($elements, array($this, 'sortElementsCallback'));

        $this->setElements($elements);

        $landingElements = $this->getElements();
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
            }elseif($landingElement->isContainer())
            {
                $landingElement->orderElements();
            }
        }
    }
}