<?php

declare(strict_types=1);

namespace App\Support\Http\Responses;

class Response implements ResponseInterface
{
    public static function json(array $data, ?int $statusCode = 200): void
    {
        (new JsonResponse())($data, $statusCode);
    }

    public static function notFound(): void
    {
        (new NotFoundResponse())();
    }
}
