<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Restaurant;

final class ShowRestaurantService extends RestaurantService
{
    public function execute(int $id): ?Restaurant
    {
        return $this->getRestaurantById($id);
    }
}
