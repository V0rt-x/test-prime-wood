<?php

namespace TestPrimeWood\Application\Requests;

use TestPrimeWood\Application\Exceptions\ValidationException;
use TestPrimeWood\Application\Validators\ValidatesRequestField;

class Request
{
    /** @var array<string, class-string> */
    protected array $rules = [];

    protected array $data = [];

    public function __construct()
    {
        $this->data = array_filter(
            array_merge($_GET, $_POST),
            fn($field) => array_key_exists($field, $this->rules),
            ARRAY_FILTER_USE_KEY
        );
    }

    /**
     * @return array
     * @throws ValidationException
     * @throws \Exception
     */
    public function validated(): array
    {
        foreach ($this->data as $field => $value) {
            $validator = new $this->rules[$field];

            if (!$validator instanceof ValidatesRequestField) {
                throw new \Exception('Валидатор должен реализовывать интерфейс ValidatesRequestField');
            }

            try {
                $validator->validate($value);
            } catch (ValidationException $e) {
                throw new ValidationException(sprintf("Поле '%s': %s", $field, $e->getMessage()));
            }
        }

        return $this->data;
    }
}