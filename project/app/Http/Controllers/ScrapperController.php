<?php

namespace App\Http\Controllers;

use App\Http\Services\ScrapperService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScrapperController extends Controller
{

    /**
     * @param ScrapperService $scrapper_service
     */
    public function __construct(public ScrapperService $scrapper_service)
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
