<?php

declare(strict_types=1);

namespace App\Support\Helpers;

class EnvHelper
{
    /**
     * @param  string $key
     * @param  string $defaultValue
     * @return string
     */
    public static function get(string $key, string $defaultValue): string
    {
        if (!empty($_ENV[$key])) {
            return $_ENV[$key];
        }

        return $defaultValue;
    }
}
