<?php

namespace migrations;

use TestPrimeWood\Infrastructure\Exceptions\PgsqlException;

class CreateProductsTable
{
    /**
     * @throws PgsqlException
     */
    public function up(): void
    {
        pgsql()->query('
CREATE TABLE products (
    id        int PRIMARY KEY,
    name      varchar(40) NOT NULL,
    price     integer NOT NULL,
    datetime  timestamp NOT NULL
)
        ');
    }
}