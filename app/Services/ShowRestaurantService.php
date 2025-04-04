<?php

declare(strict_types=1);

namespace App\Services;

final class ShowRestaurantService extends RestaurantService
{
    public function execute(int $id): \stdClass|null
    {
        return $this->getRestaurantById($id);
    }
}
