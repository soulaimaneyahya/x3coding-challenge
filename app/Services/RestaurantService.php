<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\LocationDTO;
use App\DTO\PaginationDTO;
use App\Models\Restaurant;
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
     * @return \Illuminate\Pagination\LengthAwarePaginator<\App\Models\Restaurant>
     */
    public function getRestaurantsList(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator {
        return $this->restaurantRepositoryInterface->getRestaurantsList($pagination, $location);
    }

    /**
     * @param  string $id
     * @return \App\Models\Restaurant|null
     */
    public function getRestaurantById(string $id): Restaurant|null
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
