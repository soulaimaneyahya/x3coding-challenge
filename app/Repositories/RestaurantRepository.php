<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\PaginationDTO;
use App\DTO\LocationDTO;
use App\Entities\RestaurantEntity;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\RestaurantRepositoryInterface;

final class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getRestaurantsList(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator {
        $query = DB::table('restaurants')->select([
            'id',
            'name',
            'description',
            'latitude',
            'longitude',
            'image_url',
            'created_at',
            'updated_at',
        ]);

        if ($location !== null) {
            $query->selectRaw('
                SQRT(
                    POW(69.1 * (latitude - ?), 2) + 
                    POW(69.1 * (? - longitude), 2)
                ) AS distance
            ', [
                $location->getLatitude(),
                $location->getLongitude(),
            ])
            ->havingRaw('distance <= ?', [$location->getRadius()])
            ->orderByRaw('distance');
        }

        $paginatedData = $query->paginate(
            perPage: $pagination->getPerPage(),
            page: $pagination->getPage(),
        );

        $paginatedData->getCollection()->transform(fn (\stdClass $restaurant) => $this->hydrateRestaurant($restaurant));

        return $paginatedData;
    }

    public function getRestaurantById(int $id): RestaurantEntity|null
    {
        // lock the row for the update // prevent race condition
        $restaurant = DB::select('
            SELECT id, name, description, latitude, longitude, image_url, visits_count, created_at, updated_at
            FROM restaurants 
            WHERE id = :id 
            FOR UPDATE
        ', ['id' => $id]);

        if ($restaurant === null) {
            return null;
        }

        return $this->hydrateRestaurant($restaurant[0]);
    }

    public function incrementRestaurantVisits(int $id): void
    {
        DB::statement('
            UPDATE restaurants
            SET visits_count = visits_count + 1
            WHERE id = :id
        ', ['id' => $id]);
    }

    private function hydrateRestaurant(\stdClass $restaurant): RestaurantEntity
    {
        return new RestaurantEntity(
            id: $restaurant->id,
            name: $restaurant->name,
            location: new LocationDTO(
                latitude: (float) $restaurant->latitude,
                longitude: (float) $restaurant->longitude,
                distance: $restaurant->distance ?? null,
            ),
            createdAt: $restaurant->created_at,
            updatedAt: $restaurant->updated_at,
            description: $restaurant->description,
            imageUrl: $restaurant->image_url,
            visitsCount: $restaurant->visits_count ?? null,
        );
    }
}
