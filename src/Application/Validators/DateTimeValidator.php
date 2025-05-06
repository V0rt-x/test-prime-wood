<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Validators;

use DateTime;
use TestPrimeWood\Application\Exceptions\ValidationException;
use TestPrimeWood\Domain\Entities\Product;

class DateTimeValidator implements ValidatesRequestField
{
    public function validate(mixed $value): void
    {
        $dateTimeFormat = Product::DEFAULT_DATETIME_FORMAT;
        $dateTimeObject = DateTime::createFromFormat($dateTimeFormat, $value);
        if (!$dateTimeObject || $dateTimeObject->format($dateTimeFormat) !== $value) {
            throw new ValidationException('Неверный формат даты и времени');
        }
    }
}
