<?php

namespace TestPrimeWood\Application\Responses;

class Response
{
    public function __construct(
        protected array $data = [],
        protected int $statusCode = 200,
    )
    {
    }
}