<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\ShowRestaurantService;
use App\Models\Restaurant;

final class IncrementRestaurantVisitsTest extends TestCase
{
    use RefreshDatabase;

    private Client $client;
    private string $baseUrl;
    private Restaurant $restaurant;
    private ShowRestaurantService $showRestaurantService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->baseUrl = 'http://localhost:8000';

        $this->showRestaurantService = app(ShowRestaurantService::class);

        $restaurant = $this->createRestaurant();

        if (!$restaurant instanceof Restaurant) {
            $this->fail('Restaurant not created');
        }

        $this->restaurant = $restaurant;
    }

    public function testIncrementRestaurantVisits(): void
    {
        try {
            $restaurant = $this->showRestaurantService->execute($this->restaurant->getPublicId());

            $response = $this->get("{$this->baseUrl}/api/restaurants/{$this->restaurant->getPublicId()}");

            $this->assertEquals(200, $response->getStatusCode());

            $this->assertEquals($restaurant->getVisitsCount(), 1);
        } catch (\Throwable $ex) {
            dd($ex);
        }
    }
}
