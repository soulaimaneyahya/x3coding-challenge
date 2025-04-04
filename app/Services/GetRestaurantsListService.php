<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

final class GetRestaurantsListService extends RestaurantService
{
    public function execute(
        ?float $latitude,
        ?float $longitude,
    ): LengthAwarePaginator {
        return $this->getRestaurantsList($latitude, $longitude);
    }
}
