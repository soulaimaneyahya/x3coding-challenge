<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Restaurants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowRestaurantApiResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'image' => $this->getImageUrl(),
            'location' => $this->getLocation(),
            'visitsCount' => $this->getVisitsCount(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }
}
