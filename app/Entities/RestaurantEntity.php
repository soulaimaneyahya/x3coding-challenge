<?php

declare(strict_types=1);

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

final class RestaurantEntity
{
    public const string TABLE_NAME = 'restaurants';

    public const int PER_PAGE = 10;

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly string $imageUrl,
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly string $createdAt,
        public readonly string $updatedAt,
        public readonly int|null $visitsCount = null,
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl !== null ? Storage::url($this->imageUrl) : null;
    }

    public function getLocation(): array
    {
        return [
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
        ];
    }

    public function getVisitsCount(): int|null
    {
        return $this->visitsCount ?? null;
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
