<?php

declare(strict_types=1);

namespace App\Support\Http\Responses;

class JsonResponse
{
    public function __invoke(array $data, ?int $statusCode = 200): void
    {
        /* Set the content type to JSON and charset */
        header("Content-type: application/json; charset=utf-8");

        /* Set your HTTP response code */
         http_response_code($statusCode);

        /* encode your PHP Object or Array into a JSON string. */
         echo json_encode($data);
    }
}
