<?php
declare(strict_types=1);

namespace TestPrimeWood\Domain\Services;
use TestPrimeWood\Domain\Entities\Product;
use TestPrimeWood\Infrastructure\Exceptions\PgsqlException;
use TestPrimeWood\Infrastructure\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    /**
     * @param Product $product
     * @return Product
     * @throws PgsqlException
     */
    public function store(Product $product): Product
    {
        return $this->repository->store($product);
    }

    /**
     * @return array<int, Product>
     * @throws PgsqlException
     */
    public function list(int $page, int $limit): array
    {
        return $this->repository->list($page, $limit);
    }
}