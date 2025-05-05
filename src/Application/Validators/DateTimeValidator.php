<?php

namespace TestPrimeWood\Application\Validators;

use DateTime;
use TestPrimeWood\Application\Exceptions\ValidationException;

class DateTimeValidator implements ValidatesRequestField
{
    public function validate(mixed $value): void
    {
        $dateTimeFormat = 'd.m.Y H:i:s';
        $dateTimeObject = DateTime::createFromFormat($dateTimeFormat, $value);
        if (!$dateTimeObject || $dateTimeObject->format($dateTimeFormat) !== $value) {
            throw new ValidationException('Неверный формат даты и времени. Используйте дд.мм.гггг чч:мм:сс.');
        }
    }
}
