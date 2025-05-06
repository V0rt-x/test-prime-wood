<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Validators;

use TestPrimeWood\Application\Exceptions\ValidationException;

class NaturalNumberValidator implements ValidatesRequestField
{
    public function validate(mixed $value): void
    {
        if (!ctype_digit($value)) {
            throw new ValidationException("Поле должно содержать целое число не меньше 0");
        }
    }
}