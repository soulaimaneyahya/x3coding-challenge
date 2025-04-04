<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Restaurant;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use App\Interfaces\RestaurantRepositoryInterface;

final class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getRestaurantsList(
        int $page,
        int $perPage,
        ?float $latitude,
        ?float $longitude,
    ): LengthAwarePaginator {
        return $this->baseRestaurantQuery()
            ->paginate(
                $perPage,
                $page,
            );
    }

    public function getRestaurantById(int $id): \stdClass|null
    {
        return $this->baseRestaurantQuery()->find($id);
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
