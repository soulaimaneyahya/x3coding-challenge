<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Restaurant;
use Illuminate\Pagination\LengthAwarePaginator;

final class RestaurantRepository
{
    public function getRestaurantsList(
        int $page,
        int $perPage,
        ?float $latitude,
        ?float $longitude,
    ): LengthAwarePaginator {
        return Restaurant::query()->select([
                'id',
                'name',
                'description',
                'latitude',
                'longitude',
                'image_url',
                'visits_count',
                'created_at',
                'updated_at',
            ])
            ->paginate(
                $perPage,
                $page,
            );
    }

    public function getRestaurantById(int $id): ?Restaurant
    {
        return Restaurant::query()->select([
                'id',
                'name',
                'description',
                'latitude',
                'longitude',
                'image_url',
                'visits_count',
                'created_at',
                'updated_at',
            ])->find($id);
    }
}
