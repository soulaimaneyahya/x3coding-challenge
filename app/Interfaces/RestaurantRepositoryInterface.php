<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTO\LocationDTO;
use App\DTO\PaginationDTO;
use App\Entities\RestaurantEntity;
use Illuminate\Pagination\LengthAwarePaginator;

interface RestaurantRepositoryInterface
{
    /**
     * @param  \App\DTO\PaginationDTO $pagination
     * @param  \App\DTO\LocationDTO|null $location
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getRestaurantsList(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator;

    /**
     * @param  int $id
     * @return \App\Entities\RestaurantEntity|null
     */
    public function getRestaurantById(int $id): RestaurantEntity|null;

    /**
     * @param  int $id
     * @return bool
     */
    public function incrementRestaurantVisits(int $id): bool;
}
