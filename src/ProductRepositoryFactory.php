<?php
namespace ProxyManagerExample;

use ProxyManager\Factory\AccessInterceptorValueHolderFactory;

/**
 * Class ProductRepositoryFactory
 * @package ProxyManagerExample
 */
class ProductRepositoryFactory
{
    /**
     * @var AccessInterceptorValueHolderFactory
     */
    private $valueInterceptorFactory;

    /**
     * @var ProductCache
     */
    private $productCache;

    /**
     * ProductRepositoryFactory constructor.
     * @param AccessInterceptorValueHolderFactory $valueInterceptor
     * @param ProductCache $productCache
     */
    public function __construct(AccessInterceptorValueHolderFactory $valueInterceptor, ProductCache $productCache)
    {
        $this->valueInterceptorFactory = $valueInterceptor;
        $this->productCache = $productCache;
    }


    /**
     * @return ProductRepository
     */
    public function createCachedProductRepository()
    {
        /** @var ProductRepository $proxy */
        $proxy = $this->valueInterceptorFactory->createProxy(
            new ProductRepository(),
            [
                'getProducts' => function ($proxy, $instance, $method, $params, & $returnEarly) {
                    $searchQuery = $params['searchQuery'];
                    $cacheResult = $this->productCache->findByQuery($searchQuery);
                    if (null !== $cacheResult) {
                        $returnEarly = true;

                        return $cacheResult;
                    }
                }
            ],
            [
                'getProducts' => function ($proxy, $instance, $method, $params, $returnValue, & $returnEarly) {
                    $searchQuery = $params['searchQuery'];
                    $this->productCache->cacheResult($searchQuery, $returnValue);
                }
            ]
        );

        return $proxy;
    }
}