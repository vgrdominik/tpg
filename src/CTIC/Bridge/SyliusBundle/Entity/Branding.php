<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Entity;

use Sylius\Component\Channel\Model\Channel;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;

class Branding implements BrandingInterface
{
    use ToggleableTrait;
    use TimestampableTrait;

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var Channel
     */
    protected $channel;

    /**
     * @var string|null
     */
    protected $colorPrimary = '#267699';

    /**
     * @var string|null
     */
    protected $colorSecondary = '#70B0CC';

    /**
     * @var string|null
     */
    protected $colorAccent = '#FF877A';

    /**
     * @var string|null
     */
    protected $colorSuccess = '#4CAF50';

    /**
     * @var string|null
     */
    protected $colorError = '#FF5252';

    /**
     * @var string|null
     */
    protected $colorWarning = '#FFC107';

    /**
     * @var string|null
     */
    protected $colorInfo = '#D19BA3';

    /**
     * @var string|null
     */
    protected $styleButton = 'outlined';

    /**
     * @var string|null
     */
    protected $styleForm = 'outlined';

    /**
     * @var string|null
     */
    protected $styleCard = 'shaped';

    /**
     * @var string|null
     */
    protected $styleDialogCard = 'shaped';

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param Channel $channel
     */
    public function setChannel(Channel $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return string|null
     */
    public function getColorPrimary(): ?string
    {
        return $this->colorPrimary;
    }

    /**
     * @param string|null $colorPrimary
     */
    public function setColorPrimary(?string $colorPrimary): void
    {
        $this->colorPrimary = $colorPrimary;
    }

    /**
     * @return string|null
     */
    public function getColorSecondary(): ?string
    {
        return $this->colorSecondary;
    }

    /**
     * @param string|null $colorSecondary
     */
    public function setColorSecondary(?string $colorSecondary): void
    {
        $this->colorSecondary = $colorSecondary;
    }

    /**
     * @return string|null
     */
    public function getColorAccent(): ?string
    {
        return $this->colorAccent;
    }

    /**
     * @param string|null $colorAccent
     */
    public function setColorAccent(?string $colorAccent): void
    {
        $this->colorAccent = $colorAccent;
    }

    /**
     * @return string|null
     */
    public function getColorSuccess(): ?string
    {
        return $this->colorSuccess;
    }

    /**
     * @param string|null $colorSuccess
     */
    public function setColorSuccess(?string $colorSuccess): void
    {
        $this->colorSuccess = $colorSuccess;
    }

    /**
     * @return string|null
     */
    public function getColorError(): ?string
    {
        return $this->colorError;
    }

    /**
     * @param string|null $colorError
     */
    public function setColorError(?string $colorError): void
    {
        $this->colorError = $colorError;
    }

    /**
     * @return string|null
     */
    public function getColorWarning(): ?string
    {
        return $this->colorWarning;
    }

    /**
     * @param string|null $colorWarning
     */
    public function setColorWarning(?string $colorWarning): void
    {
        $this->colorWarning = $colorWarning;
    }

    /**
     * @return string|null
     */
    public function getColorInfo(): ?string
    {
        return $this->colorInfo;
    }

    /**
     * @param string|null $colorInfo
     */
    public function setColorInfo(?string $colorInfo): void
    {
        $this->colorInfo = $colorInfo;
    }

    /**
     * @return string|null
     */
    public function getStyleButton(): ?string
    {
        return $this->styleButton;
    }

    /**
     * @param string|null $styleButton
     */
    public function setStyleButton(?string $styleButton): void
    {
        $this->styleButton = $styleButton;
    }

    /**
     * @return string|null
     */
    public function getStyleForm(): ?string
    {
        return $this->styleForm;
    }

    /**
     * @param string|null $styleForm
     */
    public function setStyleForm(?string $styleForm): void
    {
        $this->styleForm = $styleForm;
    }

    /**
     * @return string|null
     */
    public function getStyleCard(): ?string
    {
        return $this->styleCard;
    }

    /**
     * @param string|null $styleCard
     */
    public function setStyleCard(?string $styleCard): void
    {
        $this->styleCard = $styleCard;
    }

    /**
     * @return string|null
     */
    public function getStyleDialogCard(): ?string
    {
        return $this->styleDialogCard;
    }

    /**
     * @param string|null $styleDialogCard
     */
    public function setStyleDialogCard(?string $styleDialogCard): void
    {
        $this->styleDialogCard = $styleDialogCard;
    }
}
