<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\DTOs\PostDTO;
use App\DTOs\UserAnalysisDTO;
use App\Models\PostModel;
use App\Models\UserAnalysisModel;
use DateTime;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

class PostModelTest extends TestCase
{
//    protected PostModel $postModel;
//    protected array $postResponse;
//
//    public function setUp(): void
//    {
//        $this->postModel = new PostModel();
//
//        /* Delete all posts in DB */
//        $this->postModel->deleteAll();
//
//        /* Load post response json */
//        $this->postResponse = json_decode(
//            file_get_contents(__DIR__ . '/../../data/posts-response.json'),
//            associative: true,
//            flags: JSON_THROW_ON_ERROR
//        );
//    }
//    private function insertPosts(array $listOfPosts): void
//    {
//        /* Insert posts */
//        foreach ($listOfPosts as $post) {
//            $createdAt = DateTime::createFromFormat(DateTimeInterface::ATOM, $post['created_time']);
//            $this->postModel->insert(
//                new PostDTO(
//                    id: $post['id'],
//                    user_name: $post['from_name'],
//                    user_id: $post['from_id'],
//                    message: $post['message'],
//                    message_length: strlen($post['message']),
//                    type: $post['type'],
//                    created_time: $createdAt->format('Y-m-d H:i:s')
//                )
//            );
//        }
//    }
//
//    public function testCrudPostsModel()
//    {
//        $this->assertArrayHasKey('data', $this->postResponse, 'There is no data attribute.');
//        $this->assertArrayHasKey('posts', $this->postResponse['data'], 'There is no data attribute.');
//
//        $listOfPosts = $this->postResponse['data']['posts'] ?? [];
//        $this->assertNotCount(0, $listOfPosts, 'Array of posts is empty.');
//
//        /* Make sure that post table is empty  */
//        $this->assertEquals(
//            0,
//            $this->postModel->getTotal(),
//            'Posts were not deleted'
//        );
//
//        $this->insertPosts($listOfPosts);
//
//        $this->assertEquals(
//            count($listOfPosts),
//            $this->postModel->getTotal(),
//            'Posts were not inserted'
//        );
//    }
//
//    public function testLoadPostsPaginated()
//    {
//        /* Make sure that post table is empty  */
//        $this->assertEquals(
//            0,
//            $this->postModel->getTotal(),
//            'Posts were not deleted'
//        );
//
//        $listOfPosts = $this->postResponse['data']['posts'] ?? [];
//
//        $this->insertPosts($listOfPosts);
//
//        $result = $this->postModel->getPaginated(1, 15);
//
//        $this->assertCount(15, $result, 'Posts were not loaded paginated');
//    }
//
//    public function testGetUserAnalysis()
//    {
//        /* Make sure that post table is empty  */
//        $this->assertEquals(
//            0,
//            $this->postModel->getTotal(),
//            'Posts were not deleted'
//        );
//
//        $listOfPosts = $this->postResponse['data']['posts'] ?? [];
//
//        $this->insertPosts($listOfPosts);
//
//        $users = $this->postModel->getUserAnalysisData();
//        foreach ($users as $user) {
//            $this->assertArrayHasKey('user_id', $user, 'User analysis is not correct');
//            $this->assertArrayHasKey('user_name', $user, 'User analysis is not correct');
//            $this->assertArrayHasKey('post_count', $user, 'User analysis is not correct');
//            $this->assertArrayHasKey('post_sum_message_length', $user, 'User analysis is not correct');
//            $this->assertArrayHasKey('post_longest_id', $user, 'User analysis is not correct');
//
//            $postsByMonth = $this->postModel->getUsersPostsByMonth($user['user_id']);
//
//            $dto = new UserAnalysisDTO(
//                user_id: $user['user_id'],
//                user_name: $user['user_name'],
//                post_count: $user['post_count'],
//                post_avg_characters: round($user['post_sum_message_length'] / $user['post_count'], 2),
//                post_months: json_encode($postsByMonth),
//                post_longest_id: $user['post_longest_id']
//            );
//
//            $model = new UserAnalysisModel();
//            $model->insert($dto);
//        }

        //        $this->assertCount(15, $result, 'Posts were not loaded paginated');
//    }
}
