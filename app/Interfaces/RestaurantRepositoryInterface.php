<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\DTO\LocationDTO;
use App\DTO\PaginationDTO;
use App\Models\Restaurant;
use Illuminate\Pagination\LengthAwarePaginator;

interface RestaurantRepositoryInterface
{
    /**
     * @param  \App\DTO\PaginationDTO $pagination
     * @param  \App\DTO\LocationDTO|null $location
     * @return \Illuminate\Pagination\LengthAwarePaginator<\App\Models\Restaurant>
     */
    public function getRestaurantsList(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator;

    /**
     * @param  string $publicId
     * @return \App\Models\Restaurant|null
     */
    public function getRestaurantById(string $publicId): Restaurant|null;

    /**
     * @param  int $id
     * @return bool
     */
    public function incrementRestaurantVisits(int $id): bool;
}
