<?php

declare(strict_types=1);

namespace Tests\Unit\Support;

use App\Support\Http\Client\Client as HttpClient;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    /**
     * @var HttpClient
     */
    private HttpClient $httpClient;

    public function setUp(): void
    {
        $this->httpClient = new HttpClient();
    }

    public function testGetRequest(): void
    {
        $response = $this->httpClient->get('https://httpbin.org/get');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEquals(null, $response->getBody());
        $this->assertIsArray($response->getBodyArray());
    }

    public function testPostRequest(): void
    {
        $response = $this->httpClient->post('https://httpbin.org/post');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEquals(null, $response->getBody());
        $this->assertIsArray($response->getBodyArray());
    }

    public function testRequestNotFound(): void
    {
        $response = $this->httpClient->post('https://supermetrics.com/not-exist');

        $this->assertEquals(404, $response->getStatusCode());
    }
}
