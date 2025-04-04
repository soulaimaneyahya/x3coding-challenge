<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RestaurantRepositoryInterface
{
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
    ): LengthAwarePaginator;

    /**
     * @param int $id
     * @return \stdClass|null
     */
    public function getRestaurantById(int $id): \stdClass|null;
}
