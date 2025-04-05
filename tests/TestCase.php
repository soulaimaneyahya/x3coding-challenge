<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;
use App\Models\Restaurant;

abstract class TestCase extends BaseTestCase
{
    public function createRestaurant(): ?Restaurant
    {
        return Restaurant::query()->create([
            'public_id' => Str::uuid(),
            'name' => 'Restaurant',
            'description' => 'Restaurant Description',
            'image_url' => 'restaurant-imgs/restaurant-img-1.png',
            'latitude' => 50,
            'longitude' => 50,
        ]);
    }
}
