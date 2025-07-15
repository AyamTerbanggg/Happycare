<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourism extends Model
{
    use HasFactory;

    protected $table = 'tourism';

    protected $fillable = [
        'name', 'description', 'address', 'city', 'category', 'image', 'gallery',
        'rating', 'total_reviews', 'entrance_fee', 'opening_hours_start',
        'opening_hours_end', 'facilities', 'latitude', 'longitude', 'is_active',
        'price', 'facilities', 'opening_hours', 'maps_url'
    ];

    protected $casts = [
        'gallery' => 'array',
        'facilities' => 'array',
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
        'entrance_fee' => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('rating', '>=', 4.0)->orderBy('rating', 'desc');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', 'like', '%' . $city . '%');
    }
}