<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\LocationDTO;
use App\DTO\PaginationDTO;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetRestaurantsListService extends RestaurantService
{
    /**
     * @param  \App\DTO\PaginationDTO $pagination
     * @param  \App\DTO\LocationDTO|null $location
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function execute(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator {
        return $this->getRestaurantsList($pagination, $location);
    }
}
