<?php
namespace ProxyManagerExample;

/**
 * Class InMemoryProductCache
 * @package ProxyManagerExample
 */
class InMemoryProductCache implements ProductCache
{
    /**
     * @var Product[][]
     */
    private $data;

    /**
     * @inheritdoc
     */
    public function findByQuery(array $searchQuery)
    {
        $key = $this->buildKey($searchQuery);
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function cacheResult(array $searchQuery, array $products)
    {
        $key = $this->buildKey($searchQuery);
        $this->data[$key] = $products;
    }

    /**
     * @param array $searchQuery
     * @return string
     */
    private function buildKey(array $searchQuery)
    {
        return $key = serialize($searchQuery);
    }

}