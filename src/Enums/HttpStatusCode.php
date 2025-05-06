<?php
declare(strict_types=1);

namespace TestPrimeWood\Enums;

enum HttpStatusCode: int
{
    case SUCCESS = 200;

    case BAD_REQUEST = 400;

    case METHOD_NOT_ALLOWED = 405;

    case INTERNAL_SERVER_ERROR = 500;
}