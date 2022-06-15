<?php

declare(strict_types=1);

namespace App\Services;

interface CacheServiceInterface
{
    public function loadData(int $page, int $perPage): array;

    public function sync(): void;

    public function flush(): void;
}
