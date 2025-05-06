<?php
declare(strict_types=1);

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
        $serializedProduct = $product->toArray();

        $result = pgsql()->query(sprintf(
            "INSERT INTO %s (name, price, datetime) VALUES ('%s', %d, '%s') RETURNING id", self::$table,
            $serializedProduct['name'],
            $serializedProduct['price'],
            $serializedProduct['datetime']
        ))[0];

        return (clone $product)->setId($result['id']);
    }

    /**
     * @return array<int, Product>
     * @throws PgsqlException
     */
    public function list(int $page, int $limit): array
    {
        return array_map(
            fn(array $product) => Product::fromArray($product),
            pgsql()->query(sprintf("SELECT * FROM %s LIMIT %d OFFSET %d", self::$table, $limit, $page * $limit))
        );
    }
}