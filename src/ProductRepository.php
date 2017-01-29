<?php
namespace ProxyManagerExample;

/**
 * Class ProductRepository
 * @package ProxyManagerExample
 */
class ProductRepository
{
    /**
     * @param array $searchQuery
     * @return Product[]
     */
    public function getProducts(array $searchQuery)
    {
        // do some database logic

        // return collection of objects based on search query
        return [
            new Product(1, 'Clean architecture'),
            new Product(1, 'Uncle bob clean code')
        ];
    }
}