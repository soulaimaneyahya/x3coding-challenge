<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ShowRestaurantService;
final class IncrementRestaurantVisitsTest extends TestCase
{
    use RefreshDatabase;

    private Client $client;
    private string $baseUrl;
    private int $restaurantId;
    private ShowRestaurantService $showRestaurantService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->baseUrl = 'http://localhost:8000';

        $this->showRestaurantService = app(ShowRestaurantService::class);

        $this->restaurantId = $this->createRestaurant();
    }

    public function testIncrementRestaurantVisits(): void
    {
        try {
            $restaurant = $this->showRestaurantService->execute($this->restaurantId);

            $response = $this->get("{$this->baseUrl}/api/restaurants/{$this->restaurantId}");

            $this->assertEquals(200, $response->getStatusCode());

            $this->assertEquals($restaurant->getVisitsCount(), 1);
        } catch (\Throwable $ex) {
            dd($ex);
        }
    }
}
