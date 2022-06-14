<?php

declare(strict_types=1);

namespace App\Services;

use App\Support\Http\Client\Client as HttpClient;
use Exception;

/**
 *
 */
class SupermetricsApiService
{
    /**
     * @var HttpClient
     */
    private HttpClient $httpClient;
    /**
     * @var array
     */
    private array $apiConfig;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->httpClient = new HttpClient();

        // load api config
        $this->apiConfig = ConfigService::get('api');

        // Sanitize
        if (empty($this->apiConfig)) {
            throw new Exception('Supermetrics API Config not set');
        }
    }

    /**
     * @param  bool $tokenNotCached
     * @return string
     * @throws \JsonException
     */
    public function getAuthenticationToken(bool $tokenNotCached = false): string
    {
        /* Avoid new API request returning token stored in session */
        if (!$tokenNotCached && !empty($_SESSION['supermetrics_token'])) {
            return $_SESSION['supermetrics_token'];
        }

        $response = $this->httpClient->post(
            $this->apiConfig['host'] . '/assignment/register',
            [
                'client_id' => $this->apiConfig['client_id'],
                'email' => $this->apiConfig['email'],
                'name' => $this->apiConfig['name'],
             ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Error while getting token');
        }

        $arrayData = $response->getBodyArray();

        /* Store token in session */
        $_SESSION['supermetrics_token'] = $arrayData['data']['sl_token'];

        return $arrayData['data']['sl_token'];
    }

    /**
     * @param  int $pageNumber
     * @return array
     * @throws \JsonException
     */
    public function getPaginated(int $pageNumber): array
    {
        $response = $this->httpClient->get(
            $this->apiConfig['host'] . '/assignment/posts',
            [
                'sl_token' => $this->getAuthenticationToken(),
                'page' => $pageNumber,
            ]
        );

        $arrayData = $response->getBodyArray();

        return $arrayData['data']['posts'];
    }

    /**
     * @return array
     * @throws \JsonException
     */
    public function getAll(): array
    {
        $posts = [];
        $pageNumber = 1;

        while ($pageNumber <= 10) {
            $response = $this->getPaginated($pageNumber);

            if (empty($response)) {
                break;
            }

            $posts = array_merge($posts, $response);

            $pageNumber++;
        }

        return $posts;
    }
}
