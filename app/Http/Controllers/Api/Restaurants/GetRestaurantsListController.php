<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Restaurants;

use App\DTO\PaginationDTO;
use App\DTO\LocationDTO;
use App\Entities\RestaurantEntity;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\GetRestaurantsListService;
use App\Http\Requests\Api\Restaurants\GetRestaurantsListRequest;
use App\Http\Resources\Api\Restaurants\GetRestaurantsListApiResource;

final class GetRestaurantsListController extends Controller
{
    public function __construct(
        private readonly GetRestaurantsListService $getRestaurantsListService,
    ) {
    }

    /**
     * @param  GetRestaurantsListRequest $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(GetRestaurantsListRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        if (isset($validatedData['latitude']) && isset($validatedData['longitude'])) {
            $location = new LocationDTO(
                latitude: (float) $validatedData['latitude'],
                longitude: (float) $validatedData['longitude'],
            );
        }

        $restaurants = $this->getRestaurantsListService->execute(
            new PaginationDTO(
                page: (int) ($validatedData['page'] ?? 1),
                perPage: (int) ($validatedData['per_page'] ?? RestaurantEntity::PER_PAGE),
            ),
            $location ?? null,
        );

        return new JsonResponse([
            'data' => GetRestaurantsListApiResource::collection($restaurants),
            'meta' => [
                'current_page' => $restaurants->currentPage(),
                'last_page' => $restaurants->lastPage(),
                'per_page' => $restaurants->perPage(),
                'total' => $restaurants->total(),
            ],
        ]);
    }
}
