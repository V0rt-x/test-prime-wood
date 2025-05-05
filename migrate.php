<?php

require_once 'init.php';

use migrations\CreateProductsTable;

$migrations = [
    CreateProductsTable::class
];

foreach ($migrations as $migration) {
    (new $migration)->up();
}
