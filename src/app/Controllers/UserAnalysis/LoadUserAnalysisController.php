<?php

declare(strict_types=1);

namespace App\Controllers\UserAnalysis;

use App\Models\PostModel;
use App\Services\PostsCacheService;
use App\Services\UserAnalysisCacheService;
use App\Support\Helpers\Log;
use App\Support\Http\Responses\JsonResponse;
use App\Support\Http\Responses\Response;
use Exception;

class LoadUserAnalysisController
{
    protected PostModel $postModel;
    protected UserAnalysisCacheService $cacheService;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->cacheService = new UserAnalysisCacheService();
    }
    /**
     * @param array<int> $parameters
     */
    public function __invoke(?array $parameters): void
    {
        try {
            // Get Parameters
            $page = isset($parameters['page']) ? intval($parameters['page']) : 1;
            $perPage = isset($parameters['per_page']) ? intval($parameters['per_page']) : 15;

            // Get the posts from cache service and return them
            Response::json($this->cacheService->loadData($page, $perPage));
        } catch (Exception $e) {
            Log::error('LoadUserAnalysisController ERROR: ' . $e->getMessage());
            Response::json(['message' => 'Internal Error, please try again later'], 500);
        }
    }
}
