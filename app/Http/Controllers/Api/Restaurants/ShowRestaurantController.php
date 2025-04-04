<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Restaurants;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\ShowRestaurantService;
use App\Http\Resources\Api\Restaurants\ShowRestaurantApiResource;

final class ShowRestaurantController extends Controller
{
    public function __construct(
        private readonly ShowRestaurantService $showRestaurantService,
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        $restaurant = $this->showRestaurantService->execute($id);

        return new JsonResponse([
            'data' => new ShowRestaurantApiResource($restaurant),
        ]);
    }
}
