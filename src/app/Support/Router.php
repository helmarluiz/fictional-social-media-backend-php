<?php

declare(strict_types=1);

namespace App\Support;

use App\Support\Helpers\Log;
use App\Support\Http\Responses\Response;

class Router
{
    protected static int $countUrlMatches = 0;

    /**
     * @param  string $endpoint
     * @param  string $callback
     * @return void
     */
    public static function get(string $endpoint, string $callback): void
    {
        $isRequestTypeAllowed = $_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'OPTIONS';
        $urlMatches = (strtok($_SERVER["REQUEST_URI"], '?') === $endpoint);

        /* try to match REST verb and endpoint */
        if ($isRequestTypeAllowed && $urlMatches) {
            /* Sanitize GET Parameters */
            $attributes = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            self::$countUrlMatches++;
            (new $callback())($attributes);
        }
    }

    /* TODO: Implement router for the other REST verbs (ex: POST, PUT, DELETE)
        and implement support for other types of callbacks */

    public function __destruct()
    {
        /* If none of the routes matched, then we throw a 404 error. */
        if (self::$countUrlMatches === 0) {
            Response::notFound();
        }
    }
}
