<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\ConfigService;
use App\Services\SupermetricsApiService;
use App\Support\Http\Client\Client as HttpClient;
use PHPUnit\Framework\TestCase;

class SupermetricsApiServiceTest extends TestCase
{
    protected SupermetricsApiService $supermetricsApiService;

    public function setUp(): void
    {
        $this->supermetricsApiService = new SupermetricsApiService();
    }

    public function testRequestGetAuthenticationToken()
    {
        $token = $this->supermetricsApiService->getAuthenticationToken(true);

        $this->assertEquals(true, empty($token), 'Authentication token is not valid');
    }

    public function testRequestGetListOfPosts()
    {
        $arrayOfPosts = $this->supermetricsApiService->getPaginated(1);

        $this->assertEquals(false, empty($arrayOfPosts), 'List of Posts is Empty');
    }

    public function testLoadAllPosts()
    {
        $arrayOfPosts = $this->supermetricsApiService->getAll();

        $apiConfig =  ConfigService::get('api');
        $totalPosts = intval($apiConfig['total_pages']) * intval($apiConfig['total_posts_per_page']);

        $this->assertCount(
            $totalPosts,
            $arrayOfPosts,
            'Posts were not loaded'
        );
    }

    public function testExpiredTokenResponse()
    {
        $httpClient = new HttpClient();
        $apiConfig =  ConfigService::get('api');

        $response = $httpClient->get(
            "{$apiConfig['host']}/assignment/posts",
            [
                'sl_token' => 'smslt_754fcf34c8a_622b15afd7d27a1',
                'page' => 1,
            ]
        );

        $responseData = $response->getBodyArray();

        $this->assertNotEquals(200, $response->getStatusCode(), 'Http Status Code is not 500');
        $this->assertArrayHasKey('error', $responseData, 'Http Status Code is not 500');
        $this->assertEqualsIgnoringCase(
            'Invalid SL Token',
            $responseData['error']['message'],
            'There is no data attribute.'
        );
    }
}
