<?php

namespace TestPrimeWood\Application\Responses;

use TestPrimeWood\Domain\Entities\Product;
use TestPrimeWood\Enums\HttpStatusCode;

class ListProductsResponse extends Response
{
    /**
     * @param array<int, Product> $data
     * @param HttpStatusCode $statusCode
     */
    public function __construct(array $data, HttpStatusCode $statusCode = HttpStatusCode::SUCCESS)
    {
        $this->data = array_map(fn(Product $product) => [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => round($product->getPrice() / 100, 2),
            'datetime' => $product->getDatetime()?->format(Product::DEFAULT_DATETIME_FORMAT),
        ], $data);

        parent::__construct($this->data, $statusCode);
    }
}