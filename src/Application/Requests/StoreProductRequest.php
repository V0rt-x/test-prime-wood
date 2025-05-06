<?php

namespace TestPrimeWood\Application\Requests;

use DateTime;
use TestPrimeWood\Application\Validators\DateTimeValidator;
use TestPrimeWood\Application\Validators\NameValidator;
use TestPrimeWood\Application\Validators\PriceValidator;
use TestPrimeWood\Domain\Entities\Product;

class StoreProductRequest extends Request
{
    protected array $rules = [
        'name' => NameValidator::class,
        'price' => PriceValidator::class,
        'datetime' => DateTimeValidator::class,
    ];

    public function validated(): array
    {
        $data = parent::validated();

        return [
            'name' => $data['name'],
            'price' => intval(floatval($data['price']) * 100),
            'datetime' => DateTime::createFromFormat(Product::DEFAULT_DATETIME_FORMAT, $data['datetime']),
        ];
    }
}
