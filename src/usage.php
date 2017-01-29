<?php
/**
 * Created by PhpStorm.
 * User: mmalawski
 * Date: 29/01/2017
 * Time: 16:13
 */

include_once '../vendor/autoload.php';

$factory = new \ProxyManagerExample\ProductRepositoryFactory(
    new \ProxyManager\Factory\AccessInterceptorValueHolderFactory(),
    new \ProxyManagerExample\InMemoryProductCache()
);

$productRepo = $factory->createCachedProductRepository();

$products = $productRepo->getProducts(['name' => 'clean']);

$products = $productRepo->getProducts(['name' => 'clean']);