<?php

declare(strict_types=1);

namespace App\Support\Http\Client;

use JsonException;

class ClientRequestBase implements ClientRequestInterface
{
    private string $requestUrl;
    private array $requestParameters;
    private array $requestHeaders;
    protected string $responseBody;
    protected int $statusCode;

    /**
     * @param string     $requestUrl
     * @param array|null $requestParameters
     * @param array|null $requestHeaders
     */
    public function __construct(
        string $requestUrl,
        ?array $requestParameters,
        ?array $requestHeaders
    ) {
        $this->requestUrl = $requestUrl;
        $this->requestParameters = $requestParameters ?? [];
        $this->requestHeaders = $requestHeaders ?? [];
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array|null
     */
    public function getRequestParameters(): ?array
    {
        return $this->requestParameters;
    }

    /**
     * @return array
     */
    public function getRequestHeaders(): array
    {
        return $this->requestHeaders;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function getBody(): string
    {
        return $this->responseBody;
    }

    /**
     * Convert string body to array
     *
     * @throws JsonException
     */
    public function getBodyArray(): array
    {
        return json_decode(
            $this->responseBody,
            associative: true,
            flags: JSON_THROW_ON_ERROR
        );
    }

    /**
     * @return string
     */
    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    /**
     * @param string $requestUrl
     */
    public function setRequestUrl(string $requestUrl): void
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * @param  string $body
     * @return void
     */
    public function setBody(string $body): void
    {
        $this->responseBody = $body;
    }
}
