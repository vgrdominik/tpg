<?php

declare(strict_types=1);

namespace CTIC\Bridge\FOSImportExportPlugin\Processor;

use CTIC\Bridge\BitbagCMSPlugin\Entity\ProductAttribute;
use FriendsOfSylius\SyliusImportExportPlugin\Exception\AccessorNotFoundException;
use FriendsOfSylius\SyliusImportExportPlugin\Processor\MetadataValidatorInterface;
use Sonata\CoreBundle\Model\ManagerInterface;
use Sylius\Bundle\TaxonomyBundle\Doctrine\ORM\TaxonRepository;
use Sylius\Component\Attribute\AttributeType\CheckboxAttributeType;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
use Sylius\Component\Attribute\Factory\AttributeFactory;
use Sylius\Component\Attribute\Model\AttributeInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ChannelPricingInterface;
use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Model\ProductImage;
use Sylius\Component\Core\Model\ProductTaxon;
use Sylius\Component\Core\Model\ProductVariant;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Core\Repository\ProductTaxonRepositoryInterface;
use Sylius\Component\Product\Model\ProductAttributeValue;
use Sylius\Component\Product\Model\ProductInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Product\Factory\ProductFactory;
use Sylius\Component\Product\Model\ProductOption;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Sylius\Component\Product\Model\ProductOptionValue;
use Sylius\Component\Product\Model\ProductOptionValueInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxation\Model\TaxCategory;
use Sylius\Component\Taxonomy\Factory\TaxonFactory;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

final class ProductProcessor implements ProductProcessorInterface
{
    const REFERENCE_COLUMN = 'referencia';
    /**
     * @var string
     */
    private $projectDir;
    /**
     * @var TaxCategory
     */
    private $mainTax;
    /**
     * @var ChannelInterface[]
     */
    private $channel;

    /**
     * @var string[]
     */
    private $locale;

    /**
     * @var FactoryInterface
     */
    private $channelPricingFactory;

    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * @var RepositoryInterface
     */
    private $productRepository;

    /**
     * @var TaxonFactory
     */
    private $taxonFactory;

    /**
     * @var TaxonRepository
     */
    private $taxonRepository;

    /**
     * @var ManagerInterface
     */
    private $taxonManager;

    /**
     * @var FactoryInterface
     */
    private $productTaxonFactory;

    /**
     * @var ProductTaxonRepositoryInterface
     */
    private $productTaxonRepository;

    /**
     * @var AttributeFactory
     */
    private $productAttributeFactory;

    /**
     * @var FactoryInterface
     */
    private $productAttributeValueFactory;

    /**
     * @var RepositoryInterface
     */
    private $attributeValueRepository;

    /**
     * @var RepositoryInterface
     */
    private $attributeRepository;

    /**
     * @var RepositoryInterface
     */
    private $productOptionRepository;

    /**
     * @var FactoryInterface
     */
    private $productOptionFactory;

    /**
     * @var RepositoryInterface
     */
    private $productOptionValueRepository;

    /**
     * @var FactoryInterface
     */
    private $productOptionValueFactory;

    /**
     * @var FactoryInterface
     */
    private $productVariantFactory;

    /**
     * @var RepositoryInterface
     */
    private $productVariantRepository;

    /**
     * @var RepositoryInterface
     */
    private $taxRepository;

    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * @var MetadataValidatorInterface
     */
    private $metadataValidator;

    /**
     * @var ImageUploaderInterface
     */
    private $uploader;

    /**
     * @var string[]
     */
    private $headerKeys;


    /**
     * ProductProcessor constructor.
     *
     * @param string $projectDir
     * @param RepositoryInterface $channelRepository
     * @param FactoryInterface $channelPricingFactory
     * @param ProductFactory $productFactory
     * @param RepositoryInterface $productRepository
     * @param TaxonFactory $taxonFactory
     * @param RepositoryInterface $taxonRepository
     * @param $taxonManager
     * @param FactoryInterface $productTaxonFactory
     * @param ProductTaxonRepositoryInterface $productTaxonRepository
     * @param AttributeFactory $productAttributeFactory
     * @param FactoryInterface $productAttributeValueFactory
     * @param RepositoryInterface $attributeValueRepository
     * @param RepositoryInterface $attributeRepository
     * @param RepositoryInterface $productOptionRepository
     * @param FactoryInterface $productOptionFactory
     * @param RepositoryInterface $productOptionValueRepository
     * @param FactoryInterface $productOptionValueFactory
     * @param FactoryInterface $productVariantFactory
     * @param RepositoryInterface $productVariantRepository
     * @param RepositoryInterface $taxRepository
     * @param PropertyAccessorInterface $propertyAccessor
     * @param MetadataValidatorInterface $metadataValidator
     * @param ImageUploaderInterface $uploader
     * @param array $headerKeys
     */
    public function __construct(
        $projectDir,
        RepositoryInterface $channelRepository,
        FactoryInterface $channelPricingFactory,
        ProductFactory $productFactory,
        RepositoryInterface $productRepository,
        TaxonFactory $taxonFactory,
        RepositoryInterface $taxonRepository,
        $taxonManager,
        FactoryInterface $productTaxonFactory,
        ProductTaxonRepositoryInterface $productTaxonRepository,
        AttributeFactory $productAttributeFactory,
        FactoryInterface $productAttributeValueFactory,
        RepositoryInterface $attributeValueRepository,
        RepositoryInterface $attributeRepository,
        RepositoryInterface $productOptionRepository,
        FactoryInterface $productOptionFactory,
        RepositoryInterface $productOptionValueRepository,
        FactoryInterface $productOptionValueFactory,
        FactoryInterface $productVariantFactory,
        RepositoryInterface $productVariantRepository,
        RepositoryInterface $taxRepository,
        PropertyAccessorInterface $propertyAccessor,
        MetadataValidatorInterface $metadataValidator,
        ImageUploaderInterface $uploader,
        array $headerKeys
    ) {
        $this->projectDir = $projectDir;
        $this->channel = $channelRepository->findAll();
        $this->locale = array('es', 'ca_ES');
        $this->channelPricingFactory = $channelPricingFactory;
        $this->productFactory = $productFactory;
        $this->productRepository = $productRepository;
        $this->taxonFactory = $taxonFactory;
        $this->taxonRepository = $taxonRepository;
        $this->taxonManager = $taxonManager;
        $this->productTaxonFactory = $productTaxonFactory;
        $this->productTaxonRepository = $productTaxonRepository;
        $this->productAttributeFactory = $productAttributeFactory;
        $this->productAttributeValueFactory = $productAttributeValueFactory;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->attributeRepository = $attributeRepository;
        $this->productOptionRepository = $productOptionRepository;
        $this->productOptionFactory = $productOptionFactory;
        $this->productOptionValueRepository = $productOptionValueRepository;
        $this->productOptionValueFactory = $productOptionValueFactory;
        $this->productVariantFactory = $productVariantFactory;
        $this->productVariantRepository = $productVariantRepository;
        $this->taxRepository = $taxRepository;
        $this->propertyAccessor = $propertyAccessor;
        $this->metadataValidator = $metadataValidator;
        $this->uploader = $uploader;
        $this->headerKeys = $headerKeys;

        $this->mainTax = $this->taxRepository->findOneByCode('general');
    }

    /**
     * {@inheritdoc}
     */
    public function process(array $data): void
    {
        $this->metadataValidator->validateHeaders($this->headerKeys, $data);

        $product = $this->getProduct($data);

        foreach($this->channel as $channel)
        {
            $product->addChannel($channel);
        }

        foreach ($this->headerKeys as $headerKey) {
            $matchedKey = $this->getCallbackByKey($headerKey);
            $matchedKey = 'callback'.$matchedKey;

            $dataValue = $data[$headerKey];

            if (strlen((string) $dataValue) === 0 && !is_bool($dataValue)) {
                $dataValue = null;
            }

            call_user_func(array($this, $matchedKey), $product, $dataValue);

        }

        $this->setProductVariants($product);
        $this->setProduct($product);
        $this->productRepository->add($product);
        $this->addProductAttributeValues($product);
        $this->addProductTaxons($product);
    }

    /**
     * @param $string
     *
     * @return string
     */
    private function cleanString($string)
    {
        $finalCleanString = str_replace(['/', '´', '.', ':', ';', '`', '\'', '"', '^', '*', 'ç', '¨', '{', '}', '[', ']'], '_', stripslashes($string));
        $finalCleanString = strtr(utf8_decode($finalCleanString), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
        $finalCleanString = strtolower(str_replace([' '], '_', $finalCleanString));
        $finalCleanString = str_replace(['_____', '____', '___', '__'], '_', $finalCleanString);
        return $finalCleanString;
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     * @param string $headerKey
     *
     * @throws AccessorNotFoundException
     *
     * @return void
     */
    private function callbackDefault(ProductInterface $product, $dataValue, $headerKey = ''): void
    {
        if (false === $this->propertyAccessor->isReadable($product, $headerKey)) {
            throw new AccessorNotFoundException(
                sprintf(
                    'No Accessor found for %s in Resource %s, ' .
                    'please implement one or change the Header-Key to an existing field',
                    $headerKey,
                    \get_class($product)
                )
            );
        }

        $this->propertyAccessor->setValue($product, $headerKey, $dataValue);
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     * @param string $headerKey
     *
     * @return void
     */
    private function callbackProductAttributeSelect(ProductInterface $product, $dataValue, $headerKey = ''): void
    {
        $attribute = $this->getProductAttributeSelect($headerKey);

        if(!$selectChoiceKey = $this->getProductAttributeSelectChoice($attribute, $dataValue))
        {
            $attributeConfiguration = $attribute->getConfiguration();
            $selectChoiceKey = md5((string) $dataValue);
            $attributeConfiguration['choices'][$selectChoiceKey] = array();
            foreach($this->locale as $locale)
            {
                $attributeConfiguration['choices'][$selectChoiceKey][$locale] = $dataValue;
            }

            $attribute->setConfiguration($attributeConfiguration);

            $this->attributeRepository->add($attribute);

            $selectChoiceKey = $this->getProductAttributeSelectChoice($attribute, $dataValue);
        }

        $this->setProductAttributeValue($product, $attribute, $selectChoiceKey, 'select');
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     * @param string $headerKey
     *
     * @return void
     */
    private function callbackProductAttributeCheckbox(ProductInterface $product, $dataValue, $headerKey = ''): void
    {
        $attribute = $this->getProductAttributeCheckbox($headerKey);

        $this->setProductAttributeValue($product, $attribute, $dataValue);
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     * @param string $headerKey
     *
     * @return void
     */
    private function callbackProductAttributeText(ProductInterface $product, $dataValue, $headerKey = ''): void
    {
        $attribute = $this->getProductAttributeText($headerKey);

        $this->setProductAttributeValue($product, $attribute, $dataValue, 'text');
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     *
     * @return void
     */
    private function callbackImage(ProductInterface $product, $dataValue): void
    {
        $image = $product->getImagesByType('Main');
        if($image->count() == 0)
        {
            $newfile = $this->projectDir . '/web/uploads/tmp' . $product->getCode() . '.jpg';

            copy($dataValue, $newfile);
            $mimeType = mime_content_type($newfile);
            $size = filesize ($newfile);
            $finalName = $product->getCode() .".jpg";

            $image = new ProductImage();
            $file = new UploadedFile($newfile,$finalName,$mimeType, $size, null, true);

            $image->setFile($file);
            $image->setType('Main');

            $product->addImage($image);

            $this->uploader->upload($image);
        }
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     *
     * @throws AccessorNotFoundException
     *
     * @return void
     */
    private function callbackName(ProductInterface $product, $dataValue): void
    {
        if(strlen($dataValue) > 255)
        {
            $name = substr($dataValue, 0, 255);
        }else{
            $name = $dataValue;
        }
        $this->callbackDefault($product, $name, 'name');

        $slug = $this->cleanString($name);

        $this->callbackDefault($product, $slug, 'slug');

        $metaKeywords = str_replace("___", ", ", $slug);
        $metaKeywords = str_replace("__", ", ", $metaKeywords);
        $metaKeywords = str_replace("_", ", ", $metaKeywords);
        if(strlen($metaKeywords) > 255)
        {
            $metaKeywords = substr($metaKeywords, 0, 250) . '...';
        }
        $this->callbackDefault($product, $metaKeywords, 'meta_keywords');

        $this->callbackDefault($product, $dataValue, 'description');

        $metaDescription = $dataValue;
        if(strlen($metaDescription) > 255)
        {
            $metaDescription = substr($dataValue, 0, 250) . '...';
        }

        $this->callbackDefault($product, $metaDescription, 'meta_description');
        $this->callbackDefault($product, $metaDescription, 'short_description');

        for($i = 1; $i < count($this->locale); $i++)
        {
            $product->setFallbackLocale($this->locale[$i]);
            $product->setCurrentLocale($this->locale[$i]);
            $product->setName($name);
            $product->setSlug($slug);
            $product->setMetaKeywords($metaKeywords);
            $product->setDescription($dataValue);
            $product->setMetaDescription($metaDescription);
            $product->setShortDescription($metaDescription);
        }
        $product->setFallbackLocale($this->locale[0]);
        $product->setCurrentLocale($this->locale[0]);
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     *
     * @throws AccessorNotFoundException
     *
     * @return void
     */
    private function callbackSKU(ProductInterface $product, $dataValue): void
    {
        $this->callbackDefault($product, 'H_' . $dataValue, 'code');
        $this->callbackProductAttributeText($product, $dataValue, 'Referencia Proveedor');
    }

    /**
     * @param Product $product
     * @param string $dataValue
     *
     * @return void
     */
    private function callbackPrice(Product $product, $dataValue): void
    {
        $providerPriceFloat = floatval($dataValue);
        $baseFloat = $providerPriceFloat + $providerPriceFloat * 0.4;
        $priceFloat = $baseFloat + $baseFloat * 0.21;
        $intPrice =  (int)( number_format($priceFloat, 0, '.', '') * 100 + 95) ;

        /** @var ProductVariant[] $productVariants */
        $productVariants = $product->getVariants()->toArray();
        foreach($productVariants as $productVariant)
        {
            foreach($this->channel as $channel)
            {
                /** @var ChannelPricingInterface $channelPricing */
                if (!$channelPricing = $productVariant->getChannelPricingForChannel($channel)) {
                    $channelPricing = $this->channelPricingFactory->createNew();
                    $channelPricing->setChannelCode($channel->getCode());
                    $productVariant->addChannelPricing($channelPricing);
                } ;
                $channelPricing->setChannelCode($channel->getCode());
                $channelPricing->setPrice($intPrice);
                $channelPricing->setOriginalPrice($intPrice);
            }
        }
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function getTaxonomyBySerieType($name)
    {
        switch($name)
        {
            case 'Videojuego':
                return 'Videojuegos Oficial';
                break;
            case 'Película':
                return 'Películas Oficial';
                break;
            case 'Serie':
                return 'Serie Oficial';
                break;
            case 'Productor audiovisual':
                return 'Películas Oficial';
                break;
            case 'Productor de videojuegos':
                return 'Videojuegos Oficial';
                break;
            case 'Manga / Anime':
                return 'Anime Oficial';
                break;
            case 'Dibujos animados':
                return 'Dibujos Oficial';
                break;
            case 'Otros':
            default:
                return 'Otros Oficial';
                break;
        }
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function getSerieType($name)
    {
        switch($name)
        {
            case 'Assassin´s Creed':
            case 'Call of Duty':
            case 'Crash Bandicoot':
            case 'Darksiders':
            case 'Fallout':
            case 'Far Cry':
            case 'God of War':
            case 'League of Legends':
            case 'Legend of Zelda, The':
            case 'Overwatch':
            case 'Playerunknown´s Battlegrounds (PUBG)':
            case 'Pokémon':
            case 'Resident Evil':
            case 'Sea of Thieves':
            case 'Sonic - The Hedgehog':
            case 'Space Invaders':
            case 'Spyro the Dragon':
            case 'Street Fighter':
            case 'Super Mario':
            case 'Tetris':
            case 'Witcher, The':
                return 'Videojuego';
                break;
            case 'Alicia en el Pais de las Maravillas':
            case 'Alien':
            case 'Animales fantásticos':
            case 'Ant-Man':
            case 'Batman':
            case 'Beauty and the Beast':
            case 'Black Panther':
            case 'Blade Runner':
            case 'Capitán América':
            case 'Charlie y la fabrica de chocolate':
            case 'Deadpool':
            case 'Despicable Me':
            case 'El Señor de los Anillos':
            case 'Escuadrón Suicida':
            case 'Flash':
            case 'Freddy vs. Jason':
            case 'Gremlins':
            case 'Guardianes de la Galaxia':
            case 'Harry Potter':
            case 'Hulk':
            case 'Iron Man':
            case 'Justice League':
            case 'Jungle Book, The':
            case 'Jurassic Park / Jurassic World':
            case 'La naranja mecánica':
            case 'Lilo &amp; Stitch':
            case 'Linterna Verde':
            case 'Los Increíbles':
            case 'Masters of the Universe':
            case 'Pesadilla antes de Navidad':
            case 'Peter Pan':
            case 'Pocahontas':
            case 'Punisher':
            case 'Ready Player One':
            case 'Regreso al futuro':
            case 'Scooby Doo':
            case 'Star Trek':
            case 'Star Wars':
            case 'Superman':
            case 'Thor':
            case 'Toy Story':
            case 'Vengadores, Los (Marvel)':
            case 'Venom':
            case 'Wonder Woman':
            case 'X-Men':
                return 'Película';
                break;
            case 'American Horror Story':
            case 'Big Bang Theory, The':
            case 'Breaking Bad':
            case 'Empire':
            case 'Friends':
            case 'Juego de tronos':
            case 'Sons of Anarchy':
            case 'Walking Dead':
                return 'Serie';
                break;
            case 'DC Comics':
            case 'Disney':
            case 'Marvel':
                return 'Productor audiovisual';
                break;
            case 'Atari':
            case 'Nintendo':
            case 'Sony PlayStation':
                return 'Productor de videojuegos';
                break;
            case 'Attack on Titan':
            case 'Fairy Tail':
            case 'Tokyo Ghoul':
                return 'Manga / Anime';
                break;
            case 'Looney Tunes':
            case 'Los Picapiedra':
            case 'Lucky Luke':
            case 'Mega Man':
            case 'Mickey Mouse':
            case 'Tom &amp; Jerry':
            case 'Wacky Races':
                return 'Dibujos animados';
                break;
            case 'Halloween':
            case 'Magic the Gathering':
            case 'NASA':
            case 'Pusheen':
            case 'Ultimate Guard':
            case 'Westworld':
            case 'Your Name':
            default:
                return 'Otros';
                break;
        }
    }

    /**
     * @param Product $product
     * @param string $dataValue
     *
     * @return void
     */
    private function callbackTaxonomyName(Product $product, $dataValue): void
    {
        $serieType = $this->getSerieType($dataValue);
        $this->callbackProductAttributeSelect($product, $dataValue, $serieType);
        $this->callbackProductAttributeCheckbox($product, true, 'Licencia Oficial');

        $taxonomyName = $this->getTaxonomyBySerieType($serieType);

        $taxonClean = $this->cleanString($taxonomyName);

        if (!$taxon = $this->taxonRepository->findOneBySlug($taxonClean, $this->locale[0])) {
            /** @var TaxonInterface $taxon */
            $taxon = $this->taxonFactory->createNew();
            $taxon->setCode($taxonClean);
            $taxon->setName($taxonomyName);
            $taxon->setSlug($taxonClean);
            $this->taxonRepository->add($taxon);

            $productTaxon = $this->productTaxonFactory->createNew();
            $productTaxon->setProduct($product);
            $productTaxon->setTaxon($taxon);
            $productTaxon->setPosition(10);
            $product->addProductTaxon($productTaxon);
        }else{
            if (!$productTaxon = $this->productTaxonRepository->findOneBy(array(
                'product' => $product,
                'taxon' => $taxon
            ))) {
                $productTaxon = $this->productTaxonFactory->createNew();
                $productTaxon->setProduct($product);
                $productTaxon->setTaxon($taxon);
                $productTaxon->setPosition(10);

                $product->addProductTaxon($productTaxon);
            }
        }

        if ($taxonCamisetas = $this->taxonRepository->findOneBySlug('camisetas', $this->locale[0])) {
            if (!$productTaxonCamisetas = $this->productTaxonRepository->findOneBy(array(
                'product' => $product,
                'taxon' => $taxonCamisetas
            ))) {
                $productTaxonCamisetas = $this->productTaxonFactory->createNew();
                $productTaxonCamisetas->setProduct($product);
                $productTaxonCamisetas->setTaxon($taxonCamisetas);
                $productTaxonCamisetas->setPosition(10);

                $product->addProductTaxon($productTaxonCamisetas);
            }
        }

        if ($taxonChanza = $this->taxonRepository->findOneBySlug('menu-principal', $this->locale[0])) {
            if (!$productTaxonChanza = $this->productTaxonRepository->findOneBy(array(
                'product' => $product,
                'taxon' => $taxonChanza
            ))) {
                $productTaxonChanza = $this->productTaxonFactory->createNew();
                $productTaxonChanza->setProduct($product);
                $productTaxonChanza->setTaxon($taxonChanza);
                $productTaxonChanza->setPosition(10);

                $product->addProductTaxon($productTaxonChanza);
            }
        }

        $product->setMainTaxon($taxon);
    }

    /**
     * @param ProductInterface $product
     *
     * @return void
     */
    private function addProductTaxons(ProductInterface $product): void
    {
        $productTaxons = $product->getProductTaxons();
        $productTaxons = $productTaxons->toArray();

        foreach($productTaxons as $productTaxon)
        {
            $this->productTaxonRepository->add($productTaxon);
        }
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     *TODO
     * @return void
     */
    private function callbackManufacturer(ProductInterface $product, $dataValue): void
    {
        $this->callbackProductAttributeSelect($product, $dataValue, 'Fabricante');
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     *
     * @throws AccessorNotFoundException
     *
     * @return void
     */
    private function callbackDisponibility(ProductInterface $product, $dataValue): void
    {
        $this->callbackDefault($product, $dataValue, 'enabled');
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     *
     * @return void
     */
    private function callbackTax(ProductInterface $product, $dataValue): void
    {
        // This callback currently is useless
    }

    /**
     * @param string $name
     *
     * @return ProductOptionInterface
     */
    private function getProductOption($name): ProductOptionInterface
    {
        $nameClear = $this->cleanString($name);

        /** @var ProductOption $colorOption */
        $productOption = $this->productOptionRepository->findOneByCode($nameClear);
        if (null === $productOption) {
            /** @var ProductOption $productAttribute */
            $productOption = $this->productOptionFactory->createNew();

            $productOption->setCode($nameClear);
            $productOption->setName($name);
            $productOption->setPosition(10);

            $this->productOptionRepository->add($productOption);
        }

        return $productOption;
    }

    /**
     * @param string $name
     * @param ProductOptionInterface $productOption
     *
     * @return ProductOptionValueInterface
     */
    private function getProductOptionValue($name, ProductOptionInterface $productOption): ProductOptionValueInterface
    {
        $nameClear = $this->cleanString($name);

        /** @var ProductOptionValue $colorOptionValue */
        $productOptionValue = $this->productOptionValueRepository->findOneBy(array('code' => $nameClear, 'option' => $productOption));
        if (null === $productOptionValue) {
            /** @var ProductOptionValue $productOptionValue */
            $productOptionValue = $this->productOptionValueFactory->createNew();

            $productOptionValue->setCode($nameClear);
            $productOptionValue->setOption($productOption);
            $productOptionValue->setValue($name);

            $this->productOptionValueRepository->add($productOptionValue);
        }

        return $productOptionValue;
    }

    /**
     * @param ProductInterface $product
     * @param string $dataValue
     *
     * @return void
     */
    private function callbackColor(ProductInterface $product, $dataValue): void
    {
        $colorOption = $this->getProductOption('Color');
        $sizeOption = $this->getProductOption('Tallas');
        /** @var ProductVariant[] $productVariants */
        $productVariants = $product->getVariants()->toArray();

        $colors = explode('-', $dataValue);
        foreach($colors as $color)
        {
            $colorInfo = explode(':', $color);
            if(count($colorInfo) != 2)
            {
                continue;
            }

            $colorName = $colorInfo[0];
            $ssizesName = explode(' ', $colorInfo[1]);

            $colorOptionValue = $this->getProductOptionValue($colorName, $colorOption);

            foreach($ssizesName as $sizeName)
            {
                $hasVariant = false;

                $sizeOptionValue = $this->getProductOptionValue($sizeName, $sizeOption);
                /** @var ProductVariant $productVariant */
                foreach($productVariants as $productVariant)
                {
                    if($productVariant->hasOptionValue($colorOptionValue) && $productVariant->hasOptionValue($sizeOptionValue))
                    {
                        $hasVariant = true;
                        break;
                    }
                }

                if(!$hasVariant)
                {
                    /** @var ProductVariant $newProductVariant */
                    $newProductVariant = $this->productVariantFactory->createNew();
                    $newProductVariant->addOptionValue($colorOptionValue);
                    $newProductVariant->addOptionValue($sizeOptionValue);

                    $product->addVariant($newProductVariant);
                }
            }
        }

        $product->addOption($colorOption);
        $product->addOption($sizeOption);
    }

    /**
     * @param string $key
     * @return string
     */
    private function getCallbackByKey($key): string
    {
        switch($key)
        {
            case "foto":
                return 'Image';
			case "descripcion":
				 return 'Name';
            case self::REFERENCE_COLUMN:
				 return 'SKU';
			case "pvp":
				 return 'Price';
            case "descripcio_familia":
                return 'TaxonomyName';
            case "fabricant":
                return 'Manufacturer';
			case "disponible":
				 return 'Disponibility';
			case "iva":
				 return 'Tax';
			case "color":
				 return 'Color';
            default:
                return 'Default';
        }
    }

    /**
     * @param array $data
     *
     * @return Product
     */
    private function getProduct(array $data): ProductInterface
    {
        /** @var Product|null $product */
        $product = $this->productRepository->findOneBy(['code' => 'H_' . $data[self::REFERENCE_COLUMN]]);

        if (null === $product) {
            /** @var Product $product */
            $product = $this->productFactory->createWithVariant();
        }

        return $product;
    }

    /**
     * @param string $name
     *
     * @return ProductAttribute
     */
    private function getProductAttributeSelect($name): ProductAttribute
    {
        /** @var ProductAttribute|AttributeInterface|null $productAttribute */
        $productAttribute = $this->attributeRepository->findOneBy(['code' => $this->cleanString($name)]);

        if (null === $productAttribute) {
            /** @var ProductAttribute|AttributeInterface $productAttribute */
            $productAttribute = $this->productAttributeFactory->createTyped(SelectAttributeType::TYPE);

            $productAttribute->setCode($this->cleanString($name));
            $productAttribute->setName($name);
            $productAttribute->setPosition(10);

            $configuration = array(
                'choices' => array(),
                'multiple' => false,
                'min' => NULL,
                'max' => NULL,
            );

            $productAttribute->setConfiguration($configuration);

            $this->attributeRepository->add($productAttribute);
        }

        return $productAttribute;
    }

    /**
     * @param string $name
     *
     * @return ProductAttribute
     */
    private function getProductAttributeText($name): ProductAttribute
    {
        /** @var ProductAttribute|null $productAttribute */
        $productAttribute = $this->attributeRepository->findOneBy(['code' => $this->cleanString($name)]);

        if (null === $productAttribute) {
            /** @var ProductAttribute $productAttribute */
            $productAttribute = $this->productAttributeFactory->createTyped(TextAttributeType::TYPE);

            $productAttribute->setCode($this->cleanString($name));
            $productAttribute->setName($name);
            $productAttribute->setPosition(10);

            $this->attributeRepository->add($productAttribute);
        }

        return $productAttribute;
    }

    /**
     * @param string $name
     *
     * @return ProductAttribute
     */
    private function getProductAttributeCheckbox($name): ProductAttribute
    {
        /** @var ProductAttribute|null $productAttribute */
        $productAttribute = $this->attributeRepository->findOneBy(['code' => $this->cleanString($name)]);

        if (null === $productAttribute) {
            /** @var ProductAttribute $productAttribute */
            $productAttribute = $this->productAttributeFactory->createTyped(CheckboxAttributeType::TYPE);

            $productAttribute->setCode($this->cleanString($name));
            $productAttribute->setName($name);
            $productAttribute->setPosition(10);

            $this->attributeRepository->add($productAttribute);
        }

        return $productAttribute;
    }

    /**
     * @param ProductAttribute $productAttribute
     * @param string $dataValue
     *
     * @return string|int|bool
     */
    private function getProductAttributeSelectChoice(ProductAttribute $productAttribute, $dataValue)
    {
        $configuration = $productAttribute->getConfiguration();

        if(!empty($configuration['choices']) && count($configuration['choices']) > 0)
        {
            foreach($configuration['choices'] as $key => $choice)
            {
                if($choice[$this->locale[0]] == $dataValue)
                {
                    return $key;
                }
            }
        }

        return false;
    }

    /**
     * @param ProductInterface $product
     * @param AttributeInterface $productAttribute
     * @param string|int $productAttributeDataValue
     * @param string $type
     *
     * @return void
     */
    private function setProductAttributeValue(ProductInterface $product, AttributeInterface $productAttribute, $productAttributeDataValue, $type = 'default'): void
    {
        foreach($this->locale as $locale)
        {
            $productAttributeValue = $product->getAttributeByCodeAndLocale($productAttribute->getCode(), $locale);

            if (null === $productAttributeValue) {
                /** @var ProductAttributeValue $productAttributeValue */
                $productAttributeValue = $this->productAttributeValueFactory->createNew();

                $productAttributeValue->setAttribute($productAttribute);
                $productAttributeValue->setLocaleCode($locale);
                if ($type == 'select') {
                    $this->setProductAttributeValueSelectChoice($productAttributeValue, $productAttributeDataValue);
                }else if ($type == 'text') {
                    $this->setProductAttributeValueText($productAttributeValue, $productAttributeDataValue);
                } else {
                    $this->setProductAttributeValueCheckbox($productAttributeValue, $productAttributeDataValue);
                }
                $product->addAttribute($productAttributeValue);
            } elseif($productAttributeValue->getValue() != $productAttributeDataValue) {
                $productAttributeValue->setAttribute($productAttribute);
                $productAttributeValue->setLocaleCode($locale);
                if ($type == 'select') {
                    $this->setProductAttributeValueSelectChoice($productAttributeValue, $productAttributeDataValue);
                }else if ($type == 'text') {
                    $this->setProductAttributeValueText($productAttributeValue, $productAttributeDataValue);
                } else {
                    $this->setProductAttributeValueCheckbox($productAttributeValue, $productAttributeDataValue);
                }
            }
        }
    }

    /**
     * @param ProductInterface $product
     *
     * @return void
     */
    private function addProductAttributeValues(ProductInterface $product): void
    {
        $attributeValues = $product->getAttributesByLocale('es', 'es');
        $attributeValues = $attributeValues->toArray();

        foreach($attributeValues as $attributeValue)
        {
            $this->attributeValueRepository->add($attributeValue);
        }
    }

    /**
     * @param ProductInterface $product
     *
     * @return void
     */
    private function setProduct(ProductInterface $product): void
    {
        foreach($this->locale as $locale)
        {
            $manufacturer = '';
            $manufacturerAttributeValue = $product->getAttributeByCodeAndLocale('fabricante', $locale);
            if(!empty($manufacturerAttributeValue))
            {
                $manufacturer = $manufacturerAttributeValue->getValue();
                $manufacturerAttribute = $manufacturerAttributeValue->getAttribute();

                if($manufacturerAttribute->getType() == 'select')
                {
                    $manufacturer = $manufacturerAttribute->getConfiguration()['choices'][$manufacturer[0]][$this->locale[0]];
                }
            }

            $product->setFallbackLocale($locale);
            $product->setCurrentLocale($locale);

            $name = $product->getName();
            if(!empty($manufacturer))
            {
                $name .= ' ' . $manufacturer;
            }

            if($locale == 'ca_ES')
            {
                $name = str_replace('Camiseta', 'Samarreta', $name);
                $name = str_replace('camiseta', 'samarreta', $name);
            }

            $product->setName($name);

            $slug = $this->cleanString($name);
            $product->setSlug($slug);
        }

        $product->setFallbackLocale($this->locale[0]);
        $product->setCurrentLocale($this->locale[0]);
    }

    /**
     * @param ProductInterface $product
     *
     * @return void
     */
    private function setProductVariants(ProductInterface $product): void
    {
        $productVariants = $product->getVariants();
        $productVariants = $productVariants->toArray();
        /** @var ProductVariant $firstProductVariant */
        $firstProductVariant = $productVariants[0];
        $firstProductVariantChannelPricings = array();
        /** @var ChannelPricingInterface[] $firstProductVariantChannelPricingsEntities */
        $firstProductVariantChannelPricingsEntities = $firstProductVariant->getChannelPricings();
        foreach($firstProductVariantChannelPricingsEntities as $firstProductVariantChannelPricingsEntity)
        {
            $firstProductVariantChannelPricings[$firstProductVariantChannelPricingsEntity->getChannelCode()] = $firstProductVariantChannelPricingsEntity->getPrice();
        }

        $firstProductVariant->setCode($product->getCode());
        for($i = 0; $i < count($this->locale); $i++)
        {
            $firstProductVariant->setFallbackLocale($this->locale[$i]);
            $firstProductVariant->setCurrentLocale($this->locale[$i]);
            $firstProductVariant->setName('Main');
        }
        $firstProductVariant->setOnHand(0);
        $firstProductVariant->setTracked(true);
        $firstProductVariant->setTaxCategory($this->mainTax);

        /** @var ProductVariant $productVariant */
        for($i = 1; $i < count($productVariants); $i++)
        {
            $productVariant = $productVariants[$i];
            $name = '';
            $aditionalCode = '';
            $productOptionsValue = $productVariant->getOptionValues();
            /** @var ProductOptionValue $productOptionValue */
            foreach($productOptionsValue as $productOptionValue)
            {
                $name .= $productOptionValue->getCode() . ' ';
                $aditionalCode .= '_' . $productOptionValue->getCode();
            }
            $productVariant->setCode($firstProductVariant->getCode() . $aditionalCode);
            $productVariant->setName(trim($name));
            for($z = 1; $z < count($this->locale); $z++)
            {
                $productVariant->setFallbackLocale($this->locale[$z]);
                $productVariant->setCurrentLocale($this->locale[$z]);
                $productVariant->setName(trim($name));
            }
            $productVariant->setFallbackLocale($this->locale[0]);
            $productVariant->setCurrentLocale($this->locale[0]);
            $productVariant->setOnHand(10);
            $productVariant->setTracked(true);
            $productVariant->setTaxCategory($this->mainTax);
            foreach($this->channel as $channel)
            {
                $channelPrice = $firstProductVariantChannelPricings[$channel->getCode()];

                /** @var ChannelPricingInterface $channelPricing */
                if (!$channelPricing = $productVariant->getChannelPricingForChannel($channel)) {
                    $channelPricing = $this->channelPricingFactory->createNew();
                    $channelPricing->setChannelCode($channel->getCode());
                    $productVariant->addChannelPricing($channelPricing);
                } ;

                $channelPricing->setPrice($channelPrice);
                $channelPricing->setOriginalPrice($channelPrice);
            }
        }
    }

    /**
     * @param AttributeValueInterface $productAttributesValue
     * @param string|int $productAttributeSelectChoice
     *
     * @return void
     */
    private function setProductAttributeValueSelectChoice(AttributeValueInterface $productAttributesValue, $productAttributeSelectChoice): void
    {
        $productAttributesValue->setValue(array($productAttributeSelectChoice));
    }

    /**
     * @param AttributeValueInterface $productAttributesValue
     * @param string|int|bool $productAttributeDefaultValue
     *
     * @return void
     */
    private function setProductAttributeValueCheckbox(AttributeValueInterface $productAttributesValue, $productAttributeDefaultValue): void
    {
        $productAttributesValue->setValue((bool) $productAttributeDefaultValue);
    }

    /**
     * @param AttributeValueInterface $productAttributesValue
     * @param string|int $productAttributeDefaultValue
     *
     * @return void
     */
    private function setProductAttributeValueText(AttributeValueInterface $productAttributesValue, $productAttributeDefaultValue): void
    {
        $productAttributesValue->setValue($productAttributeDefaultValue);
    }
}
