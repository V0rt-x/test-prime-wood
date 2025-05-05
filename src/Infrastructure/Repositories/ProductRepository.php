<?php

namespace TestPrimeWood\Infrastructure\Repositories;

use TestPrimeWood\Domain\Entities\Product;
use TestPrimeWood\Infrastructure\Exceptions\PgsqlException;

class ProductRepository
{
    protected static string $table = 'products';

    /**
     * @param Product $product
     * @return Product
     * @throws PgsqlException
     */
    public function store(Product $product): Product
    {
        $result = pgsql()->query(sprintf("INSERT INTO %s (name, price, datetime) VALUES (%s, %d, %d)", self::$table,
            $product->getName(),
            $product->getPrice(),
            $product->getDatetime()->getTimestamp()
        ));

        return (clone $product)->setId($result['id']);
    }

    /**
     * @return array<int, Product>
     * @throws PgsqlException
     */
    public function list(int $page, int $limit): array
    {
        return array_map(
            fn(array $product) => new Product($product['name'], $product['price'], $product['datetime'], $product['id']),
            pgsql()->query(sprintf("SELECT * FROM %s LIMIT %d OFFSET %d", self::$table, $limit, $page * $limit))
        );
    }
}