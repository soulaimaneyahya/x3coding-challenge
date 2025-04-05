<?php

declare(strict_types=1);

namespace App\DTO;

final class LocationDTO
{
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude,
    ) {
    }
}
