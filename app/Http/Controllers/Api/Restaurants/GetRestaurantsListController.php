<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Restaurants;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\GetRestaurantsListService;
use App\Http\Requests\Api\Restaurants\GetRestaurantsListRequest;

final class GetRestaurantsListController extends Controller
{
    public function __construct(
        private readonly GetRestaurantsListService $getRestaurantsListService,
    ) {
    }

    public function __invoke(GetRestaurantsListRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $restaurants = $this->getRestaurantsListService->execute(
            $validatedData['latitude'] ?? null,
            $validatedData['longitude'] ?? null,
        );

        return response()->json($restaurants);
    }
}
