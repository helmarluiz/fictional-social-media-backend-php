<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\PostDTO;
use App\Models\PostModel;
use App\Support\Helpers\Log;
use Exception;

class PostsCacheService
{
    protected SupermetricsApiService $supermetricsApiService;
    protected PostModel $postModel;

    public function __construct()
    {
        $this->supermetricsApiService = new SupermetricsApiService();
        $this->postModel = new PostModel();
    }

    public function loadData(int $page, int $perPage): array
    {
        try {
            $totalPosts = $this->postModel->getTotal();
            $apiConfig =  ConfigService::get('api');

            $expectedTotalPosts = intval($apiConfig['total_pages']) * intval($apiConfig['total_posts_per_page']);
            if ($totalPosts < $expectedTotalPosts) {
                $this->sync();
                $totalPosts = $this->postModel->getTotal();
            }

            return [
                'total' => $totalPosts,
                'data' => $this->postModel->getPaginated($page, $perPage)
            ];
        } catch (Exception $e) {
            Log::error('Cache sync error: ' . $e->getMessage());
            throw new Exception('Error while loading cache data');
        }
    }


    public function sync(): void
    {
        try {
            // Remove all posts from the database
            $this->flush();

            // Get all posts from Supermetrics API
            $posts = $this->supermetricsApiService->getAll();

            foreach ($posts as $post) {
                // Insert each post into the database
                $this->postModel->insert(
                    new PostDTO(
                        id: $post['id'],
                        user_name: $post['from_name'],
                        user_id: $post['from_id'],
                        message: $post['message'],
                        message_length: strlen($post['message']),
                        type: $post['type'],
                        created_time: $post['created_time']
                    )
                );
            }
        } catch (Exception $e) {
            Log::error('Cache sync error: ' . $e->getMessage());
            throw new Exception('Error while syncing cache');
        }
    }

    public function flush(): void
    {
        try {
            // Remove all posts from the database
            $this->postModel->deleteAll();
        } catch (Exception $e) {
            Log::error('Cache flush error: ' . $e->getMessage());
            throw new Exception('Error while flushing cache');
        }
    }
}
