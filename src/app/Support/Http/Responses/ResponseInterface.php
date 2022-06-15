<?php

declare(strict_types=1);

namespace App\Support\Http\Responses;

interface ResponseInterface
{
    public static function json(array $data, ?int $statusCode = 200): void;

    public static function notFound(): void;

    /* TODO: Implement support to other response types, ex: html, redirect and etc */
    /* TODO: implement support to set custom headers */
}
