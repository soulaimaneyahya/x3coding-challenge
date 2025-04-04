<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

final class GetRestaurantsListService extends RestaurantService
{
    /**
     * @param int $page
     * @param int $perPage
     * @param float|null $latitude
     * @param float|null $longitude
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function execute(
        int $page,
        int $perPage,
        ?float $latitude,
        ?float $longitude,
    ): LengthAwarePaginator {
        return $this->getRestaurantsList($page, $perPage, $latitude, $longitude);
    }
}
