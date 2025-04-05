<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Restaurants;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\ShowRestaurantService;
use App\Http\Resources\Api\Restaurants\RestaurantApiResource;

final class ShowRestaurantController extends Controller
{
    public function __construct(
        private readonly ShowRestaurantService $showRestaurantService,
    ) {
    }

    /**
     * @param  int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        return new JsonResponse([
            'data' => new RestaurantApiResource(
                $this->showRestaurantService->execute($id),
            ),
        ]);
    }
}
