<?php

namespace App\Http\Controllers\Api\Restaurants;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GetRestaurantsListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
    }
}
