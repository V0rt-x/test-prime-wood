<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Validators;

use TestPrimeWood\Application\Exceptions\ValidationException;

interface ValidatesRequestField
{
    /**
     * @param mixed $value
     * @throws ValidationException
     */
    public function validate(mixed $value): void;
}