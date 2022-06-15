<?php

declare(strict_types=1);

namespace App\DTOs;

class UserAnalysisDTO
{
    public function __construct(
        public string $user_id,
        public string $user_name,
        public int $post_count,
        public float $post_avg_characters,
        public string $post_months,
        public string $post_longest_id
    ) {
    }
}
