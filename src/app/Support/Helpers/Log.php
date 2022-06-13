<?php

namespace App\Support\Helpers;

use Exception;

/**
 * Describes log levels.
 */
class LogLevel
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';
}

define('LOG_FILE', __DIR__ . '/../../../logs/app.log');

/**
 * Logs messages to a file.
 */
class Log
{
    /* TODO: Implement all PSR-3 Logger Interface methods */

    /**
     * @param string $message
     * @param array|null $data
     * @return void
     */
    public static function info(string $message, ?array $data = [])
    {
        self::write(LogLevel::INFO, $message, $data);
    }

    /**
     * @param string $message
     * @param array|null $data
     * @return void
     */
    public static function debug(string $message, ?array $data = [])
    {
        self::write(LogLevel::DEBUG, $message, $data);
    }

    /**
     * @param string $message
     * @param array|null $data
     * @return void
     */
    public static function error(string $message, ?array $data = [])
    {
        self::write(LogLevel::ERROR, $message, $data);
    }

    /**
     * @param string $level
     * @param string $message
     * @param array $data
     * @return void
     */
    public static function write(string $level, string $message, array $data = [])
    {
        try {
            $formattedMessage = sprintf(
                "%s [%s] %s %s\n",
                date("Y-m-d H:i:s"),
                $level,
                $message,
                json_encode($data)
            );

            file_put_contents(LOG_FILE, $formattedMessage, FILE_APPEND);
        } catch (Exception $e) {
            error_log(' ERROR on trying to format image: ' . $e->getMessage());
        }
    }
}
