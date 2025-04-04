<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Restaurants;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\ShowRestaurantService;

final class ShowRestaurantController extends Controller
{
    public function __construct(
        private readonly ShowRestaurantService $showRestaurantService,
    ) {
    }

    public function __invoke(int $id): JsonResponse
    {
        $restaurant = $this->showRestaurantService->execute($id);

        return response()->json($restaurant);
    }
}
