<?php

declare(strict_types=1);

namespace App\Support\Http\Responses;

class NotFoundResponse
{
    public function __invoke(): void
    {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }
}
