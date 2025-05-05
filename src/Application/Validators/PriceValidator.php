<?php

namespace TestPrimeWood\Application\Validators;

use TestPrimeWood\Application\Exceptions\ValidationException;

class PriceValidator implements ValidatesRequestField
{
    public function validate(mixed $value): void
    {
        if (!preg_match('/^d+(.d{2})?$/', $value)) {
            throw new ValidationException('Цена должна быть в формате 10.00.');
        }
    }
}