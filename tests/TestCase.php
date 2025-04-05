<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    public function createRestaurant(): int
    {
        return DB::table('restaurants')->insertGetId([
            'name' => 'Restaurant',
            'description' => 'Restaurant Description',
            'image_url' => 'restaurant-imgs/restaurant-img-1.png',
            'latitude' => 50,
            'longitude' => 50,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
