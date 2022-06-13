<?php

declare(strict_types=1);

namespace App\Support;

use App\Services\ConfigService;
use App\Support\Helpers\Log;
use PDO;
use PDOException;
use Exception;

class MysqlConnect
{
    /**
     * @var PDO|null
     */
    private ?PDO $instance = null;

    /**
     * @return PDO
     * @throws Exception
     */
    public function connect(): PDO
    {
        /* If PDO Instance was already created, then return it */
        if ($this->instance) {
            return $this->instance;
        }

        try {
            $dbConfig = ConfigService::get('database');

            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s;port=%d',
                $dbConfig['host'],
                $dbConfig['database'],
                'utf8mb4',
                3306
            );

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->instance = new PDO($dsn, $dbConfig['user'], $dbConfig['password'], $options);
        } catch (PDOException $e) {
            throw new Exception('Failed to connect to the database: ' . $e->getMessage());
        }
        return $this->instance;
    }
}
