<?php

declare(strict_types=1);

namespace App\Support\Http\Client;

class Client implements ClientInterface
{
    public function get(string $url, ?array $data = null, ?array $headers = []): HttpGetRequest
    {
        $client = new HttpGetRequest($url, $data, $headers);
        return $client->request();
    }

    public function post(string $url, ?array $data = null, ?array $headers = []): HttpPostRequest
    {
        $client = new HttpPostRequest($url, $data, $headers);
        return $client->request();
    }

    /* TODO: Implement the others REST verbs, ex: PUT and DELETE */
}
