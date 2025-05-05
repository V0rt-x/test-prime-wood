<?php

namespace TestPrimeWood\Application\Requests;

use TestPrimeWood\Application\Exceptions\ValidationException;
use TestPrimeWood\Application\Validators\ValidatesRequestField;

class Request
{
    /** @var array<string, ValidatesRequestField> */
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
     */
    public function validated(): array
    {
        foreach ($this->data as $field => $value) {
            $this->rules[$field]->validate($value);
        }

        return $this->data;
    }
}