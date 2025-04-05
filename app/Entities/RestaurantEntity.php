<?php

declare(strict_types=1);

namespace App\Entities;

use Carbon\Carbon;
use App\DTO\LocationDTO;
use Illuminate\Support\Facades\Storage;

final class RestaurantEntity
{
    public const string TABLE_NAME = 'restaurants';

    public const int PER_PAGE = 10;

    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly LocationDTO $location,
        private readonly string $createdAt,
        private readonly string $updatedAt,
        private readonly string|null $description = null,
        private readonly string|null $imageUrl = null,
        private readonly int|null $visitsCount = null,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->imageUrl;
    }

    public function getImageUrl(): string
    {
        return $this->getImage() !== null ? Storage::url($this->getImage()) : null;
    }

    public function getLocation(): array
    {
        return [
            'latitude' => $this->location->getLatitude(),
            'longitude' => $this->location->getLongitude(),
        ];
    }

    public function getVisitsCount(): int|null
    {
        return $this->visitsCount;
    }

    public function getCreatedAt(): Carbon
    {
        return Carbon::parse($this->createdAt);
    }

    public function getUpdatedAt(): Carbon
    {
        return Carbon::parse($this->updatedAt);
    }
}
