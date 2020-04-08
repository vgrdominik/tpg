<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Sylius\Component\Core\Model\ImagesAwareInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ImageInterface;

class BlockSliderElement implements BlockSliderElementInterface, ImagesAwareInterface
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var int
     */
    protected $position;

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $titleAnimation = '';

    /**
     * @var string
     */
    protected $mainPhrase = '';

    /**
     * @var string
     */
    protected $mainPhraseAnimation = '';

    /**
     * @var string
     */
    protected $link = '';

    /**
     * @var string
     */
    protected $linkAnimation = '';

    /**
     * @var string
     */
    protected $linkText = '';

    /**
     * @var BlockSliderInterface
     */
    protected $owner;

    /**
     * @var Collection|ImageInterface[]
     */
    protected $images;

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
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitleAnimation(): ?string
    {
        return $this->titleAnimation;
    }

    /**
     * @param string $titleAnimation
     */
    public function setTitleAnimation(string $titleAnimation): void
    {
        $this->titleAnimation = $titleAnimation;
    }

    /**
     * @return string
     */
    public function getMainPhrase(): ?string
    {
        return $this->mainPhrase;
    }

    /**
     * @param string $mainPhrase
     */
    public function setMainPhrase(string $mainPhrase): void
    {
        $this->mainPhrase = $mainPhrase;
    }

    /**
     * @return string
     */
    public function getMainPhraseAnimation(): ?string
    {
        return $this->mainPhraseAnimation;
    }

    /**
     * @param string $mainPhraseAnimation
     */
    public function setMainPhraseAnimation(string $mainPhraseAnimation): void
    {
        $this->mainPhraseAnimation = $mainPhraseAnimation;
    }

    /**
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLinkAnimation(): ?string
    {
        return $this->linkAnimation;
    }

    /**
     * @param string $linkAnimation
     */
    public function setLinkAnimation(string $linkAnimation): void
    {
        $this->linkAnimation = $linkAnimation;
    }

    /**
     * @return string
     */
    public function getLinkText(): ?string
    {
        return $this->linkText;
    }

    /**
     * @param string $linkText
     */
    public function setLinkText($linkText): void
    {
        $this->linkText = $linkText;
    }

    /**
     * @return BlockSliderInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param BlockSliderInterface $owner
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function getImagesByType(string $type): Collection
    {
        return $this->images->filter(function (ImageInterface $image) use ($type) {
            return $type === $image->getType();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function hasImages(): bool
    {
        return !$this->images->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ImageInterface $image): void
    {
        $image->setOwner($this);
        $this->images->add($image);
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }
}
