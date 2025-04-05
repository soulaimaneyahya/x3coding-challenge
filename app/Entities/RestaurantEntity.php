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
        private int $visitsCount = 0,
        private readonly string $createdAt,
        private readonly string $updatedAt,
        private readonly string|null $description = null,
        private readonly string|null $imageUrl = null,
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

    /**
     * we can use FileSystem service to get the image url
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->getImage() !== null ? Storage::url($this->getImage()) : null;
    }

    public function getLocation(): array
    {
        return[
            'latitude' => $this->location->getLatitude(),
            'longitude' => $this->location->getLongitude(),
        ];
    }

    public function getDistance(): array
    {
        return $this->location->getDistance() != 0 ? [
            'radius' => $this->location->getRadius(),
            'distance' => $this->location->getDistance(),
        ] : [];
    }

    public function getVisitsCount(): int
    {
        return $this->visitsCount;
    }

    public function setVisitsCount(int $visitsCount): void
    {
        $this->visitsCount = $visitsCount;
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
