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

    /**
     * @param  string $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(string $id): JsonResponse
    {
        return new JsonResponse([
            'data' => new ShowRestaurantApiResource(
                $this->showRestaurantService->execute($id),
            ),
        ]);
    }
}
