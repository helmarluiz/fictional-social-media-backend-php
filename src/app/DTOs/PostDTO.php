<?php

declare(strict_types=1);

namespace App\DTOs;

class PostDTO
{
    public function __construct(
        public string $id = '',
        public string $user_name = '',
        public string $user_id = '',
        public string $message = '',
        public int $message_length = 0,
        public string $type = '',
        public string $created_time = ''
    ) {
    }
}
