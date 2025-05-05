<?php

namespace TestPrimeWood\Application\Requests;

use TestPrimeWood\Application\Validators\DateTimeValidator;
use TestPrimeWood\Application\Validators\NameValidator;
use TestPrimeWood\Application\Validators\PriceValidator;

class StoreProductRequest extends Request
{
    protected array $rules = [
        'name' => NameValidator::class,
        'price' => PriceValidator::class,
        'datetime' => DateTimeValidator::class,
    ];
}
