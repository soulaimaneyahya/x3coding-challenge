<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTO\LocationDTO;
use App\DTO\PaginationDTO;
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
     * @return \stdClass|null
     */
    public function getRestaurantById(int $id): \stdClass|null;
}
