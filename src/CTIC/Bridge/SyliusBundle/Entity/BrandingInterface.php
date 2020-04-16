<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Entity;

use Sylius\Component\Channel\Model\Channel;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface BrandingInterface extends
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
}
