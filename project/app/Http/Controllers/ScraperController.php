<?php

namespace App\Http\Controllers;

use App\Http\Services\ScraperService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScraperController extends Controller
{

    /**
     * @param ScraperService $scrapper_service
     */
    public function __construct(public ScraperService $scrapper_service)
    {

    }

    /**
     * @param string $username
     * @param Request $request
     * @return JsonResponse
     */
    public function getPostsByUsername(string $username, Request $request): JsonResponse
    {
        return response()->json($this->scrapper_service->getPostsByUsername($username, $request->get('after')));
    }
}
