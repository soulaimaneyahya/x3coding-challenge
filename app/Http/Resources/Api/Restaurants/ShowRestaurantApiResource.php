<?php

namespace App\Http\Resources\Api\Restaurants;

use Illuminate\Http\Request;

class ShowRestaurantApiResource extends RestaurantApiResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->getLocation(),
            'image' => $this->image_url,
            'visitsCount' => $this->visits_count,
        ];
    }
}
