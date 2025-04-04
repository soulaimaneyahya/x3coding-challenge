<?php

namespace App\Http\Resources\Api\Restaurants;

use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantApiResource extends JsonResource
{
    /**
     * @return array<string, float>
     */
    protected function getLocation(): array
    {
        return [
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
        ];
    }
}
