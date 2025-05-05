<?php

namespace TestPrimeWood\Application\Validators;

use TestPrimeWood\Application\Exceptions\ValidationException;

class NaturalNumberValidator implements ValidatesRequestField
{
    public function validate(mixed $value): void
    {
        if (!is_int($value) || $value < 0) {
            throw new ValidationException("$value не является натуральным числом");
        }
    }
}