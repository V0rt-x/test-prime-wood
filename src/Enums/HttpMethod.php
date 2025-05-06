<?php
declare(strict_types=1);

namespace TestPrimeWood\Enums;

enum HttpMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
}