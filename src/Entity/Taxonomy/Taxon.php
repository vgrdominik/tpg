<?php

declare(strict_types=1);

namespace App\Entity\Taxonomy;

use CTIC\Bridge\BitbagCMSPlugin\Entity\TaxonInterface;
use Doctrine\ORM\Mapping as ORM;
use CTIC\Bridge\BitbagCMSPlugin\Entity\Taxon as BaseTaxon;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_taxon")
 */
class Taxon extends BaseTaxon implements TaxonInterface
{
}
