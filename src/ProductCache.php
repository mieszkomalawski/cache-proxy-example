<?php
namespace ProxyManagerExample;

/**
 * Class Cache
 * @package ProxyManagerExample
 */
interface ProductCache
{
    /**
     * @param array $searchQuery
     * @return Product[]
     */
    public function findByQuery(array $searchQuery);

    /**
     * @param array $searchQuery
     * @param Product[] $products
     */
    public function cacheResult(array $searchQuery, array $products);
}