<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Attribute\Model\AttributeTranslationInterface;
use Sylius\Component\Product\Model\ProductAttribute as BaseProductAttribute;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product_attribute")
 */
class ProductAttribute extends BaseProductAttribute
{

    /** @var int|null */
    protected $landing;

    protected function createTranslation(): AttributeTranslationInterface
    {
        return new ProductAttributeTranslation();
    }

    /**
     * @return int|null
     */
    public function getLanding(): ?int
    {
        return $this->landing;
    }

    /**
     * @param int|null $landing
     */
    public function setLanding(?int $landing): void
    {
        $this->landing = $landing;
    }
}
