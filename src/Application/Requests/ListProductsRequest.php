<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Requests;

use TestPrimeWood\Application\Validators\NaturalNumberValidator;

class ListProductsRequest extends Request
{
    protected array $rules = [
        'page' => NaturalNumberValidator::class,
        'limit' => NaturalNumberValidator::class,
    ];
}