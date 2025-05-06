<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Responses;

use TestPrimeWood\Domain\Entities\Product;
use TestPrimeWood\Enums\HttpStatusCode;

class StoreProductResponse extends Response
{
    protected mixed $data;
    protected HttpStatusCode $statusCode = HttpStatusCode::SUCCESS;

    public function __construct(Product $data, HttpStatusCode $statusCode = HttpStatusCode::SUCCESS)
    {
        $this->data = [
            'id' => $data->getId(),
            'name' => $data->getName(),
            'price' => round($data->getPrice() / 100, 2),
            'datetime' => $data->getDatetime()?->format(Product::DEFAULT_DATETIME_FORMAT),
        ];

        parent::__construct($this->data, $statusCode);
    }
}