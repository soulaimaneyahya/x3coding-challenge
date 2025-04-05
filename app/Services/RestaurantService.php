<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\LocationDTO;
use App\DTO\PaginationDTO;
use App\Entities\RestaurantEntity;
use App\Interfaces\RestaurantRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class RestaurantService
{
    public function __construct(
        private readonly RestaurantRepositoryInterface $restaurantRepositoryInterface,
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
        return $this->restaurantRepositoryInterface->getRestaurantsList($pagination, $location);
    }

    /**
     * @param  string $id
     * @return \App\Entities\RestaurantEntity|null
     */
    public function getRestaurantById(string $id): RestaurantEntity|null
    {
        return $this->restaurantRepositoryInterface->getRestaurantById($id);
    }

    /**
     * @param  int $id
     * @return bool
     */
    public function incrementRestaurantVisits(int $id): bool
    {
        return $this->restaurantRepositoryInterface->incrementRestaurantVisits($id);
    }
}
