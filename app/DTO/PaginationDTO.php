<?php

declare(strict_types=1);

namespace App\DTO;

final class PaginationDTO
{
    public function __construct(
        private readonly int $page,
        private readonly int $perPage,
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
