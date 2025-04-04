<?php

declare(strict_types=1);

namespace App\DTO;

final class PaginationDTO
{
    public function __construct(
        public readonly int $page,
        public readonly int $perPage,
    ) {
    }
}
