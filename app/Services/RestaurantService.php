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

    /**
     * @param int $page
     * @param int $perPage
     * @param float|null $latitude
     * @param float|null $longitude
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getRestaurantsList(
        int $page,
        int $perPage,
        ?float $latitude,
        ?float $longitude,
    ): LengthAwarePaginator {
        return $this->restaurantRepository->getRestaurantsList($page, $perPage, $latitude, $longitude);
    }

    /**
     * @param int $id
     * @return \stdClass|null
     */
    public function getRestaurantById(int $id): \stdClass|null
    {
        return $this->restaurantRepository->getRestaurantById($id);
    }
}
