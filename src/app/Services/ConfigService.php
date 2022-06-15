<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Class ConfigService
 *
 * @package App\Services
 */
class ConfigService
{
    /**
     * @var bool
     */
    protected static bool $isInitialised = false;

    /**
     * @var array
     */
    protected static array $config = [];

    /**
     * @return void
     */
    public static function init(): void
    {
        static::$config = array_merge(
            include __DIR__ . '/../../config/database.php',
            include __DIR__ . '/../../config/api.php',
        );

        static::$isInitialised = true;
    }


    /**
     * @param  string $key
     * @return array|null
     */
    public static function get(string $key): array|null
    {
        if (false === static::$isInitialised) {
            static::init();
        }

        return array_key_exists($key, static::$config)
            ? static::$config[$key]
            : null;
    }
}
