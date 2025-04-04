<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory;
    /** @use SoftDeletes */
    use SoftDeletes;

    public const PER_PAGE = 10;

    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'image_url',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
