<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Restaurants;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\GetRestaurantsListService;
use App\Http\Requests\Api\Restaurants\GetRestaurantsListRequest;
use App\Http\Resources\Api\Restaurants\RestaurantsListApiResource;

final class GetRestaurantsListController extends Controller
{
    public function __construct(
        private readonly GetRestaurantsListService $getRestaurantsListService,
    ) {
    }

    /**
     * @param GetRestaurantsListRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(GetRestaurantsListRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $restaurants = $this->getRestaurantsListService->execute(
            ((int) ($validatedData['page'] ?? 1)),
            ((int) ($validatedData['per_page'] ?? Restaurant::PER_PAGE)),
            $validatedData['latitude'] ?? null,
            $validatedData['longitude'] ?? null,
        );

        return new JsonResponse([
            'data' => RestaurantsListApiResource::collection($restaurants),
            'meta' => [
                'current_page' => $restaurants->currentPage(),
                'last_page' => $restaurants->lastPage(),
                'per_page' => $restaurants->perPage(),
                'total' => $restaurants->total(),
            ],
        ]);
    }
}
