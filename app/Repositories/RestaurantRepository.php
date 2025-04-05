<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\PaginationDTO;
use App\DTO\LocationDTO;
use App\Models\Restaurant;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\RestaurantRepositoryInterface;

final class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getRestaurantsList(
        PaginationDTO $pagination,
        ?LocationDTO $location,
    ): LengthAwarePaginator {
        $query = Restaurant::query()->select([
            'id',
            'public_id',
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

        $paginatedData->getCollection()->transform(fn (Restaurant $restaurant) => $this->hydrateRestaurant(
            $restaurant,
        ));

        return $paginatedData;
    }

    public function getRestaurantById(string $publicId): Restaurant|null
    {
        $restaurant = Restaurant::query()
            ->where('public_id', $publicId)
            ->select([
                'id',
                'public_id',
                'name',
                'description',
                'latitude',
                'longitude',
                'image_url',
                'visits_count',
                'created_at',
                'updated_at',
            ])
            ->first();

        if (!$restaurant instanceof Restaurant) {
            return null;
        }

        return $this->hydrateRestaurant($restaurant);
    }

    public function incrementRestaurantVisits(int $id): bool
    {
        return Restaurant::query()
            ->where('id', $id)
            ->limit(1)
            ->increment('visits_count', 1) > 0;
    }

    private function hydrateRestaurant(Restaurant $restaurant): Restaurant
    {
        return $restaurant->setLocation(
            new LocationDTO(
                latitude: (float) $restaurant->latitude,
                longitude: (float) $restaurant->longitude,
                distance: (float) $restaurant->distance ?? 0,
            )
        );
    }
}
