<?php

namespace App\Models;

use App\DTO\LocationDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Restaurant extends Model
{
    /** @use HasFactory<\Database\Factories\RestaurantFactory> */
    use HasFactory;
    /** @use SoftDeletes */
    use SoftDeletes;

    public const string TABLE_NAME = 'restaurants';

    public const int PER_PAGE = 10;

    public LocationDTO $location;

    protected $fillable = [
        'public_id',
        'name',
        'description',
        'latitude',
        'longitude',
        'image_url',
    ];

    protected $hidden = [
        'id',
        'deleted_at',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getPublicId(): string
    {
        return $this->public_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image_url;
    }

    /**
     * we can use FileSystem service to get the image url
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        return $this->getImage() !== null ? Storage::url($this->getImage()) : null;
    }

    public function getLocation(): array
    {
        return[
            'latitude' => $this->location->getLatitude(),
            'longitude' => $this->location->getLongitude(),
        ];
    }

    public function getDistance(): array
    {
        return $this->location->getDistance() != 0 ? [
            'radius' => $this->location->getRadius(),
            'distance' => $this->location->getDistance(),
        ] : [];
    }

    public function setLocation(LocationDTO $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getVisitsCount(): int
    {
        return $this->visits_count;
    }

    public function setVisitsCount(int $visitsCount): void
    {
        $this->setAttribute('visits_count', $visitsCount);
    }

    public function getCreatedAt(): \Carbon\Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): \Carbon\Carbon
    {
        return $this->updated_at;
    }
}
