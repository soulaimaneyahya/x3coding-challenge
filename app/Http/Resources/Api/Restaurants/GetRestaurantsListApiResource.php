<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Restaurants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class GetRestaurantsListApiResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getPublicId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'image' => $this->getImageUrl(),
            'location' => $this->getLocation(),
            'distance' => $this->getDistance(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
        ];
    }
}
