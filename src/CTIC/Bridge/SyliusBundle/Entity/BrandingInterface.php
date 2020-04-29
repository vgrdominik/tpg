<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Entity;

use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface BrandingInterface extends
    ResourceInterface,
    ToggleableInterface,
    TimestampableInterface
{

    /**
     * @return ChannelInterface
     */
    public function getChannel();

    /**
     * @param ChannelInterface $channel
     */
    public function setChannel(ChannelInterface $channel): void;
}
