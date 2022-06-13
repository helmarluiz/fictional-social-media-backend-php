<?php

declare(strict_types=1);

namespace App\Support\Http\Client;

interface ClientRequestInterface
{
    public function getBody(): string;

    public function setBody(string $body): void;

    public function getBodyArray(): array;

    public function getStatusCode(): int;

    public function setStatusCode(int $statusCode): void;
}
