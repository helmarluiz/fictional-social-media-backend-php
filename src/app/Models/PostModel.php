<?php

declare(strict_types=1);

namespace App\Models;

use App\DTOs\PostDTO;
use App\Support\Helpers\Log;
use PDO;
use App\Support\MysqlConnect;
use PDOException;
use Exception;

class PostModel
{
    private string $table_name = 'posts';
    private PDO $connection;

    public function __construct()
    {
        $this->connection = (new MysqlConnect())->connect();
    }

    /**
     * @param int $page
     * @param int $per_page
     * @return array<array>
     * @throws Exception
     */
    public function getPaginated(int $page, int $per_page): array
    {
        try {
            $query = "SELECT * FROM {$this->table_name} ORDER BY created_time DESC LIMIT :offset, :per_page";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':offset', ($page - 1) * $per_page, PDO::PARAM_INT);
            $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            Log::error("SQL ERROR: [{$query}]" . $e->getMessage());
            throw new Exception('Error on trying to load all paginated');
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function deleteAll(): void
    {
        try {
            $query = "DELETE FROM {$this->table_name}";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
        } catch (PDOException $e) {
            Log::error("SQL ERROR: [{$query}]" . $e->getMessage());
            throw new Exception('Error on trying to delete all posts');
        }
    }

    /**
     * @param PostDTO $post
     * @return bool
     * @throws Exception
     */
    public function insert(PostDTO $post): bool
    {
        try {
             $sql = "INSERT INTO {$this->table_name}
                (id, user_name, user_id, message, message_length, type, created_time)
                VALUES (:id, :user_name, :user_id, :message, :message_length, :type, :created_time)
                ON DUPLICATE KEY UPDATE id = id";

            $result = $this->connection->prepare($sql);

            return $result->execute([
                'id' => $post->id,
                'user_name' => $post->user_name,
                'user_id' => $post->user_id,
                'message' => $post->message,
                'message_length' => $post->message_length,
                'type' => $post->type,
                'created_time' => $post->created_time
             ]);
        } catch (PDOException $e) {
            Log::error('PDO ERROR:' . $e->getMessage());
            throw new Exception('Error on trying to insert post');
        }
    }

    /**
     * @return int
     * @throws Exception
     */
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
            throw new Exception('Error on trying to count posts');
        }
    }


    /**
     * @return array<array>
     * @throws Exception
     */
    public function getUserAnalysisData(): array
    {
        try {
            $query = "
                SELECT
                user_id,
                user_name,
                count(id) AS post_count,
                sum(message_length) AS post_sum_message_length,
                (
                    SELECT id FROM posts as p
                              WHERE p.user_id = posts.user_id
                              ORDER BY message_length DESC LIMIT 1
                ) AS post_longest_id
                FROM {$this->table_name}
                GROUP BY user_id,user_name
                ORDER BY user_name ASC";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            Log::error("SQL ERROR: [{$query}]" . $e->getMessage());
            throw new Exception('Error on trying to count posts');
        }
    }

    /**
     * @param string $userId
     * @return array<array>
     * @throws Exception
     */
    public function getUsersPostsByMonth(string $userId): array
    {
        try {
            $query = "
                SELECT
                    date_format(created_time, '%b-%Y') as label,
                    count(*) as count
                FROM {$this->table_name}
                WHERE user_id = :user_id AND
                created_time > DATE_SUB(now(), INTERVAL 6 MONTH)
                GROUP BY date_format(created_time, '%m-%Y')
                ORDER BY created_time DESC";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':user_id', $userId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            Log::error("SQL ERROR: [{$query}]" . $e->getMessage());
            throw new Exception('Error on trying to count posts');
        }
    }
}
