<?php
declare(strict_types=1);

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
    id        int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name      varchar(40) NOT NULL,
    price     integer NOT NULL,
    datetime  timestamp NOT NULL
)
        ');
    }
}