<?php

declare(strict_types=1);

namespace App\Support\Http\Client;

interface ClientInterface
{
    public function get(string $url, ?array $data = null, ?array $headers = []): HttpGetRequest;

    public function post(string $url, ?array $data = null, ?array $headers = []): HttpPostRequest;
}
