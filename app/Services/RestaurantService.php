<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\RestaurantRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Restaurant;

class RestaurantService
{
    public function __construct(
        private readonly RestaurantRepository $restaurantRepository,
    ) {
    }

    public function getRestaurantsList(
        ?float $latitude,
        ?float $longitude,
    ): LengthAwarePaginator {
        return $this->restaurantRepository->getRestaurantsList($latitude, $longitude);
    }

    public function getRestaurantById(int $id): ?Restaurant
    {
        return $this->restaurantRepository->getRestaurantById($id);
    }
}
