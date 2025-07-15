<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialty',
        'hospital_id',
        'image',
        'description',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}