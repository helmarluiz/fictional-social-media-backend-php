<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Support\Http\Client\Client as HttpClient;
use PHPUnit\Framework\TestCase;

class PostsApiTest extends TestCase
{
    protected HttpClient $httpClient;

    public function setUp(): void
    {
        $this->httpClient = new HttpClient();
    }

    public function testGetPosts()
    {
        //        $response = $this->httpClient->get(
        //            'fsm-nginx/api/posts',
        //            [
        //                'page' => 1,
        //                'per_page' => 15,
        //            ]
        //        );
        //
        //        $this->assertEquals(200, $response->getStatusCode(), 'Invalid Http Status Code');
        //        $this->assertArrayHasKey('data', $response->getBodyArray(), 'There is no data attribute.');
        //        $this->assertCount(15, $response->getBodyArray()['data'], 'Response is not paginated');
    }
}
