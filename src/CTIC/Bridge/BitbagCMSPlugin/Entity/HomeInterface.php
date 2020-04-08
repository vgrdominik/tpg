<?php

declare(strict_types=1);

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Sylius\Component\Channel\Model\Channel;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface HomeInterface extends
    ResourceInterface,
    ToggleableInterface,
    TimestampableInterface
{

    /**
     * @return Channel
     */
    public function getChannel();

    /**
     * @param Channel $channel
     */
    public function setChannel(Channel $channel): void;

    /**
     * @return Landing
     */
    public function getLanding();

    /**
     * @param Landing $landing
     */
    public function setLanding(Landing $landing): void;
}
