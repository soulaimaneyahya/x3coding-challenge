<?php

declare(strict_types=1);

namespace App\Services;

final class ShowRestaurantService extends RestaurantService
{
    /**
     * @param int $id
     * @return \stdClass|null
     */
    public function execute(int $id): \stdClass|null
    {
        return $this->getRestaurantById($id);
    }
}
