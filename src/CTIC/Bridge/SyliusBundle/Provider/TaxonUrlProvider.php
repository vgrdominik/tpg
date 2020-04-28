<?php

declare(strict_types=1);

namespace CTIC\Bridge\SyliusBundle\Provider;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;
use Symfony\Component\Routing\RouterInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

final class TaxonUrlProvider implements UrlProviderInterface
{
    /**
     * @var RepositoryInterface
     */
    private $taxonRepository;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var SitemapUrlFactoryInterface
     */
    private $sitemapUrlFactory;

    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @var bool
     */
    private $excludeTaxonRoot = true;

    /**
     * TaxonUrlProvider constructor.
     * @param RepositoryInterface $taxonRepository
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     * @param LocaleContextInterface $localeContext
     * @param bool $excludeTaxonRoot
     */
    public function __construct(
        RepositoryInterface $taxonRepository,
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory,
        LocaleContextInterface $localeContext,
        $excludeTaxonRoot
    ) {
        $this->taxonRepository = $taxonRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->localeContext = $localeContext;
        $this->excludeTaxonRoot = $excludeTaxonRoot;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'taxons';
    }

    /**
     * {@inheritdoc}
     */
    public function generate(): iterable
    {
        foreach ($this->getTaxons() as $taxon) {
            /** @var TaxonInterface $taxon */
            if ($this->excludeTaxonRoot && $taxon->isRoot()) {
                continue;
            }
            $taxonUrl = $this->sitemapUrlFactory->createNew();
            $taxonUrl->setChangeFrequency(ChangeFrequency::always());
            $taxonUrl->setPriority(0.5);
            /** @var TaxonTranslationInterface $translation */
            foreach ($taxon->getTranslations() as $translation) {
                $location = '#';
                if ($translation->getLocale() === $this->localeContext->getLocaleCode()) {
                    $taxonUrl->setLocalization($location);
                    continue;
                }
                if ($translation->getLocale()) {
                    $taxonUrl->addAlternative($location, $translation->getLocale());
                }
            }
            $this->urls[] = $taxonUrl;
        }
        return $this->urls;
    }

    /**
     * @return array|TaxonInterface[]
     */
    private function getTaxons(): iterable
    {
        /** @var TaxonInterface[] $taxons */
        $taxons = $this->taxonRepository->findAll();
        $taxons = new ArrayCollection($taxons);

        /** @var TaxonInterface[] $mainTaxons */
        $mainTaxons = array();
        foreach($taxons as $taxon)
        {
            $parentTaxon = $taxon->getParent();
            if(!empty($parentTaxon) && $parentTaxon->getId() == 2)
            {
                $mainTaxons[] = $taxon;
            }
        }

        $criteriaChilds = Criteria::create();
        $criteriaChilds->where(Criteria::expr()->in('parent', $mainTaxons));
        /** @var TaxonInterface[] $childTaxons */
        $childTaxons = $taxons->matching($criteriaChilds)->toArray();

        return array_merge($mainTaxons, $childTaxons);
    }
}
