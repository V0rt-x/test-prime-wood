<?php
declare(strict_types=1);

namespace TestPrimeWood\Application\Responses;

use TestPrimeWood\Enums\HttpStatusCode;

class Response
{
    protected mixed $data;
    protected HttpStatusCode $statusCode = HttpStatusCode::SUCCESS;

    public function __construct(mixed $data, HttpStatusCode $statusCode = HttpStatusCode::SUCCESS)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function setStatusCode(HttpStatusCode $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatusCode(): HttpStatusCode
    {
        return $this->statusCode;
    }

    public function toJson(): string
    {
        return json_encode($this->data);
    }
}