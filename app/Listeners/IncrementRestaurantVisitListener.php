<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\IncrementRestaurantVisitEvent;
use App\Interfaces\RestaurantRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

final class IncrementRestaurantVisitListener implements ShouldQueue
{
    public function __construct(
        private readonly RestaurantRepositoryInterface $restaurantRepository,
    ) {
    }

    public function handle(IncrementRestaurantVisitEvent $event): void
    {
        $isIncremented = $this->restaurantRepository->incrementRestaurantVisits($event->restaurantId);

        if ($isIncremented !== true) {
            // we can use LoggerService
            Log::error('Failed to increment restaurant visits', [
                'restaurant_id' => $event->restaurantId,
                'error' => 'Failed to increment restaurant visits',
            ]);
        }
    }
}
