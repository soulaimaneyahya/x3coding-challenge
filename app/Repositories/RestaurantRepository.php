<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\PaginationDTO;
use App\DTO\LocationDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\RestaurantRepositoryInterface;

final class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getRestaurantsList(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator {
        $query = $this->baseRestaurantQuery();

        if ($location !== null) {
            // TODO: distance calculation
        }

        return $query->paginate(
            perPage: $pagination->perPage,
            page: $pagination->page,
        );
    }

    public function getRestaurantById(int $id): \stdClass|null
    {
        return $this->baseRestaurantQuery()
            ->where('id', $id)
            ->first();
    }

    private function baseRestaurantQuery(): Builder
    {
        return DB::table('restaurants')->select([
            'id',
            'name',
            'description',
            'latitude',
            'longitude',
            'image_url',
            'visits_count',
            'created_at',
            'updated_at',
        ]);
    }
}
