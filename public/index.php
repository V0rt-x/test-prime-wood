<?php
declare(strict_types=1);

require_once '../init.php';

use TestPrimeWood\Application\Controllers\ProductsController;
use TestPrimeWood\Application\Exceptions\ValidationException;
use TestPrimeWood\Application\Requests\ListProductsRequest;
use TestPrimeWood\Application\Requests\StoreProductRequest;
use TestPrimeWood\Application\Responses\Response;
use TestPrimeWood\Enums\HttpMethod;
use TestPrimeWood\Enums\HttpStatusCode;

try {
    $productsController = new ProductsController();

    $response = match (HttpMethod::tryFrom($_SERVER['REQUEST_METHOD'])) {
        HttpMethod::GET => $productsController->list(new ListProductsRequest()),
        HttpMethod::POST => $productsController->store(new StoreProductRequest()),
        default => new Response([], HttpStatusCode::METHOD_NOT_ALLOWED),
    };
} catch (Throwable $exception) {
    $response = new Response(['error' => [
        'message' => $exception->getMessage(),
        'code' => $exception->getCode(),
        'backtrace' => $exception->getTraceAsString(),
    ]], $exception instanceof ValidationException ? HttpStatusCode::BAD_REQUEST : HttpStatusCode::INTERNAL_SERVER_ERROR);
}

http_response_code($response->getStatusCode()->value);
header('Content-Type: application/json');
echo $response->toJson();
