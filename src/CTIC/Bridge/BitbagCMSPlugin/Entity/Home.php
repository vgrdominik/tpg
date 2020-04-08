<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Sylius\Component\Channel\Model\Channel;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;

class Home implements HomeInterface
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
     * @var Landing
     */
    protected $landing;

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
     * @return Landing
     */
    public function getLanding()
    {
        return $this->landing;
    }

    /**
     * @param Landing $landing
     */
    public function setLanding(Landing $landing): void
    {
        $this->landing = $landing;
    }
}