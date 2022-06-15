<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\PostDTO;
use App\DTOs\UserAnalysisDTO;
use App\Models\PostModel;
use App\Models\UserAnalysisModel;
use App\Support\Helpers\Log;
use Exception;

/**
 *
 */
class UserAnalysisCacheService implements CacheServiceInterface
{
    protected SupermetricsApiService $supermetricsApiService;
    protected UserAnalysisModel $userAnalysisModel;
    protected PostModel $postModel;

    /**
     *
     */
    public function __construct()
    {
        $this->supermetricsApiService = new SupermetricsApiService();
        $this->userAnalysisModel = new UserAnalysisModel();
        $this->postModel = new PostModel();
    }

    /**
     * @param  int $page
     * @param  int $perPage
     * @return array
     * @throws Exception
     */
    public function loadData(int $page, int $perPage): array
    {
        try {
            $totalPosts = $this->userAnalysisModel->getTotal();
            $apiConfig =  ConfigService::get('api');

            $expectedTotalPosts = intval($apiConfig['total_pages']) * intval($apiConfig['total_posts_per_page']);
            if ($totalPosts < $expectedTotalPosts) {
                $this->sync();
                $totalPosts = $this->userAnalysisModel->getTotal();
            }

            return [
                'total' => $totalPosts,
                'data' => $this->userAnalysisModel->getPaginated($page, $perPage)
            ];
        } catch (Exception $e) {
            Log::error('Cache sync error: ' . $e->getMessage());
            throw new Exception('Error while loading cache data');
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function sync(): void
    {
        try {
            // Remove all posts from the database
            $this->flush();

            $users = $this->postModel->getUserAnalysisData();

            foreach ($users as $user) {
                $postsByMonth = $this->postModel->getUsersPostsByMonth($user['user_id']);

                $this->userAnalysisModel->insert(
                    new UserAnalysisDTO(
                        user_id: $user['user_id'],
                        user_name: $user['user_name'],
                        post_count: $user['post_count'],
                        post_avg_characters: round($user['post_sum_message_length'] / $user['post_count'], 2),
                        post_months: json_encode($postsByMonth),
                        post_longest_id: $user['post_longest_id']
                    )
                );
            }
        } catch (Exception $e) {
            Log::error('Cache sync error: ' . $e->getMessage());
            throw new Exception('Error while syncing cache');
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function flush(): void
    {
        try {
            // Remove all posts from the database
            $this->userAnalysisModel->deleteAll();
        } catch (Exception $e) {
            Log::error('Cache flush error: ' . $e->getMessage());
            throw new Exception('Error while flushing cache');
        }
    }
}
