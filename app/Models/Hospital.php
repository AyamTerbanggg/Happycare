<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'phone',
        'email',
        'description',
        'facilities',
        'latitude',
        'longitude',
        'opening_hours_start',
        'opening_hours_end',
        'is_active',
        'website',
        'image',
        'rating'
    ];

    protected $casts = [
        'facilities' => 'array',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', 'like', "%{$city}%");
    }

    public function scopeByFacility($query, $facility)
    {
        return $query->whereJsonContains('facilities', $facility);
    }

    public function scopeFeatured($query)
    {
        return $query->where('rating', '>=', 4.0)->orderBy('rating', 'desc');
    }
}