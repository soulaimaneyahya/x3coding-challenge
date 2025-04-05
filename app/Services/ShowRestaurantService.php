<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\RestaurantEntity;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Response;

final class ShowRestaurantService extends RestaurantService
{
    /**
     * @param  string $id
     * @return \App\Entities\RestaurantEntity
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\HttpKernel\Exception\BadRequestHttpException
     */
    public function execute(string $id): RestaurantEntity
    {
        DB::beginTransaction();

        try {
            $restaurant = $this->getRestaurantById($id);

            if ($restaurant === null) {
                throw new NotFoundHttpException(
                    message: 'Restaurant not found',
                    code: Response::HTTP_NOT_FOUND,
                );
            }

            $isIncremented = $this->incrementRestaurantVisits($restaurant->getId());

            if ($isIncremented === false) {
                throw new BadRequestHttpException(
                    message: 'Failed to increment restaurant visits',
                    code: Response::HTTP_BAD_REQUEST,
                );
            }

            DB::commit();

            $restaurant->setVisitsCount($restaurant->getVisitsCount() + 1);

            return $restaurant;
        } catch (\Throwable $ex) {
            DB::rollBack();

            throw $ex;
        }
    }
}
