<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowRestaurantService extends RestaurantService
{
    /**
     * @param  int $id
     * @return \stdClass|null
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function execute(int $id): \stdClass
    {
        DB::beginTransaction();

        try {
            $restaurant = $this->getRestaurantById($id);

            if ($restaurant === null) {
                throw new NotFoundHttpException('Restaurant not found');
            }

            $this->incrementRestaurantVisits($id);

            DB::commit();

            return $restaurant;
        } catch (\Throwable $ex) {
            DB::rollBack();

            throw $ex;
        }
    }
}
