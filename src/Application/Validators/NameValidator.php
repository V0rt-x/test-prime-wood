<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Validators;

use TestPrimeWood\Application\Exceptions\ValidationException;

class NameValidator implements ValidatesRequestField
{
    public function validate(mixed $value): void
    {
        if (empty($value)) {
            throw new ValidationException('Наименование товара не может быть пустым.');
        }
    }
}