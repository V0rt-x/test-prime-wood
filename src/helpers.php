<?php

use TestPrimeWood\Infrastructure\Drivers\Database\PgsqlDriver;

function pgsql(): PgsqlDriver
{
    return PgsqlDriver::getInstance();
}

function env(string $key, mixed $default = null): mixed
{
    return $_ENV[$key] ?? $default;
}