<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface BlockSliderElementInterface extends
    ResourceInterface
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
     * @return int
     */
    public function getPosition(): ?int;

    /**
     * @param int $position
     */
    public function setPosition(int $position): void;

    /**
     * @return string
     */
    public function getTitle(): ?string;

    /**
     * @param string $title
     */
    public function setTitle(string $title): void;

    /**
     * @return string
     */
    public function getTitleAnimation(): ?string;

    /**
     * @param string $titleAnimation
     */
    public function setTitleAnimation(string $titleAnimation): void;

    /**
     * @return string
     */
    public function getMainPhrase(): ?string;

    /**
     * @param string $mainPhrase
     */
    public function setMainPhrase(string $mainPhrase): void;

    /**
     * @return string
     */
    public function getMainPhraseAnimation(): ?string;

    /**
     * @param string $mainPhraseAnimation
     */
    public function setMainPhraseAnimation(string $mainPhraseAnimation): void;

    /**
     * @return string
     */
    public function getLink(): ?string;

    /**
     * @param string $link
     */
    public function setLink(string $link): void;

    /**
     * @return string
     */
    public function getLinkAnimation(): ?string;

    /**
     * @param string $linkAnimation
     */
    public function setLinkAnimation(string $linkAnimation): void;

    /**
     * @return string
     */
    public function getLinkText(): ?string;

    /**
     * @param string $linkText
     */
    public function setLinkText($linkText): void;
}
