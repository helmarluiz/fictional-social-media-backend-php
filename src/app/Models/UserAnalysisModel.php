<?php

declare(strict_types=1);

namespace App\Models;

use App\DTOs\UserAnalysisDTO;
use App\Support\Helpers\Log;
use App\Support\MysqlConnect;
use Exception;
use PDO;
use PDOException;

class UserAnalysisModel
{
    private string $table_name = 'user_analysis';
    private PDO $connection;

    public function __construct()
    {
        $this->connection = (new MysqlConnect())->connect();
    }

    public function getPaginated(int $page, int $per_page): array
    {
        try {
            $query = "SELECT
                        {$this->table_name}.user_id,
                        {$this->table_name}.user_name,
                        post_count,
                        post_avg_characters,
                        post_months,
                        p.message as longest_post
                        FROM {$this->table_name}
                        JOIN posts as p ON p.id = {$this->table_name}.post_longest_id
                        ORDER BY user_name ASC LIMIT :offset, :per_page";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':offset', ($page - 1) * $per_page, PDO::PARAM_INT);
            $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            Log::error("SQL ERROR HERE: [{$query}]" . $e->getMessage());
            throw new Exception('Error on trying to load all paginated');
        }
    }

    public function insert(UserAnalysisDTO $userAnalysis): bool
    {
        try {
            $sql = "INSERT INTO {$this->table_name}
                (user_id, user_name, post_count, post_avg_characters, post_months, post_longest_id)
                VALUES (:user_id, :user_name, :post_count, :post_avg_characters, :post_months, :post_longest_id)
                ON DUPLICATE KEY UPDATE user_id = user_id";

            $result = $this->connection->prepare($sql);

            return $result->execute([
                'user_id' => $userAnalysis->user_id,
                'user_name' => $userAnalysis->user_name,
                'post_count' => $userAnalysis->post_count,
                'post_avg_characters' => $userAnalysis->post_avg_characters,
                'post_months' => $userAnalysis->post_months,
                'post_longest_id' => $userAnalysis->post_longest_id
            ]);
        } catch (PDOException $e) {
            Log::error('PDO ERROR:' . $e->getMessage());
            throw new Exception('Error on trying to insert user analysis');
        }
    }

    public function getTotal(): int
    {
        try {
            $query = "SELECT COUNT(*) as total FROM {$this->table_name}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            Log::error("SQL ERROR: [{$query}]" . $e->getMessage());
            throw new Exception('Error on trying to count user analysis');
        }
    }

    public function deleteAll(): void
    {
        try {
            $query = "DELETE FROM {$this->table_name}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
        } catch (PDOException $e) {
            Log::error("SQL ERROR: [{$query}]" . $e->getMessage());
            throw new Exception('Error on trying to delete user analysis');
        }
    }
}
