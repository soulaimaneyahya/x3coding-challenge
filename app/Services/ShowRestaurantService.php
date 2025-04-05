<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Restaurant;
use App\Events\IncrementRestaurantVisitEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpFoundation\Response;

final class ShowRestaurantService extends RestaurantService
{
    /**
     * @param  string $id
     * @return \App\Models\Restaurant
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function execute(string $id): Restaurant
    {
        $restaurant = $this->getRestaurantById($id);

        if (!$restaurant instanceof Restaurant) {
            throw new NotFoundHttpException(
                message: 'Restaurant not found',
                code: Response::HTTP_NOT_FOUND,
            );
        }

        IncrementRestaurantVisitEvent::dispatch($restaurant->getId());

        $restaurant->setVisitsCount($restaurant->getVisitsCount() + 1);

        return $restaurant;
    }
}
