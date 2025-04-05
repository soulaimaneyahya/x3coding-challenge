<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\LocationDTO;
use App\DTO\PaginationDTO;
use App\Entities\RestaurantEntity;
use App\Repositories\RestaurantRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class RestaurantService
{
    public function __construct(
        private readonly RestaurantRepository $restaurantRepository,
    ) {
    }

    /**
     * @param  \App\DTO\PaginationDTO $pagination
     * @param  \App\DTO\LocationDTO|null $location
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getRestaurantsList(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator {
        return $this->restaurantRepository->getRestaurantsList($pagination, $location);
    }

    /**
     * @param  int $id
     * @return \App\Entities\RestaurantEntity|null
     */
    public function getRestaurantById(int $id): RestaurantEntity|null
    {
        return $this->restaurantRepository->getRestaurantById($id);
    }

    /**
     * @param  int $id
     * @return void
     */
    public function incrementRestaurantVisits(int $id): void
    {
        $this->restaurantRepository->incrementRestaurantVisits($id);
    }
}
