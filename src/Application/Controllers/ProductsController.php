<?php

namespace TestPrimeWood\Application\Controllers;

use DateTime;
use TestPrimeWood\Application\Exceptions\ValidationException;
use TestPrimeWood\Application\Requests\ListProductsRequest;
use TestPrimeWood\Application\Requests\StoreProductRequest;
use TestPrimeWood\Application\Responses\Response;
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
     * @return Response
     * @throws ValidationException|PgsqlException
     */
    public function store(StoreProductRequest $request): Response
    {
        $data = $request->validated();

        $storedProduct = $this->service->store(new Product(
            $data['name'],
            intval(floatval($data['price']) * 100),
            DateTime::createFromFormat('', $data['datetime']),
        ));

        return new Response($storedProduct->toArray());
    }

    /**
     * @param ListProductsRequest $request
     * @return Response
     * @throws PgsqlException
     * @throws ValidationException
     */
    public function list(ListProductsRequest $request): Response
    {
        $data = $request->validated();
        $products = $this->service->list($data['page'], $data['limit']);

        return new Response(array_map(fn(Product $product) => $product->toArray(), $products));
    }
}