<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Controllers;

use TestPrimeWood\Application\Exceptions\ValidationException;
use TestPrimeWood\Application\Requests\ListProductsRequest;
use TestPrimeWood\Application\Requests\StoreProductRequest;
use TestPrimeWood\Application\Responses\ListProductsResponse;
use TestPrimeWood\Application\Responses\StoreProductResponse;
use TestPrimeWood\Domain\Entities\Product;
use TestPrimeWood\Domain\Services\ProductService;
use TestPrimeWood\Infrastructure\Exceptions\PgsqlException;

class ProductsController
{
    protected ProductService $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    /**
     * @param StoreProductRequest $request
     * @return StoreProductResponse
     * @throws ValidationException|PgsqlException
     */
    public function store(StoreProductRequest $request): StoreProductResponse
    {
        $data = $request->validated();

        $storedProduct = $this->service->store(new Product(
            $data['name'],
            $data['price'],
            $data['datetime'],
        ));

        return new StoreProductResponse($storedProduct);
    }

    /**
     * @param ListProductsRequest $request
     * @return ListProductsResponse
     * @throws PgsqlException
     * @throws ValidationException
     */
    public function list(ListProductsRequest $request): ListProductsResponse
    {
        $data = $request->validated();
        $products = $this->service->list(
            intval($data['page'] ?? 0),
            intval($data['limit'] ?? 100)
        );

        return new ListProductsResponse($products);
    }
}