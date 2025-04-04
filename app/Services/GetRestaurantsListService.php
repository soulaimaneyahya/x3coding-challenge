<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

final class GetRestaurantsListService extends RestaurantService
{
    public function execute(
        int $page,
        int $perPage,
        ?float $latitude,
        ?float $longitude,
    ): LengthAwarePaginator {
        return $this->getRestaurantsList($page, $perPage, $latitude, $longitude);
    }
}
