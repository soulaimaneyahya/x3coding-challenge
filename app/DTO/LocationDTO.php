<?php

declare(strict_types=1);

namespace App\DTO;

final class LocationDTO
{
    /**
     * @param  float $latitude coordinates latitude
     * @param  float $longitude coordinates longitude
     * @param  int $radius radius in kilometers
     * @param  float|null $distance distance in kilometers
     */
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude,
        private readonly int $radius = 10,
        private readonly float|null $distance = null,
    ) {
    }

    public function getLatitude(): float
    {
        return round($this->latitude, 8);
    }

    public function getLongitude(): float
    {
        return round($this->longitude, 8);
    }

    /**
     * for radius, we use integer to avoid unnecessary SQL decimal precision
     * @return int radius in kilometers
     */
    public function getRadius(): int
    {
        return $this->radius;
    }

    public function getDistance(): float|null
    {
        return $this->distance !== null ? round($this->distance, 8) : null;
    }
}
