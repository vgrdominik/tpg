<?php

namespace CTIC\Bridge\BitbagCMSPlugin\Entity;

use Sylius\Component\Product\Model\ProductAttribute as BaseProductAttribute;

class ProductAttribute extends BaseProductAttribute implements ProductAttributeInterface
{
    /**
     * @var Landing
     */
    protected $landing;

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