<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster_url',
        'floor_area',
        'type',
        'price',
        'hotel_id',
    ];

    // Связь "многие ко многим" с удобствами
    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_room');
    }

    // Связь "один ко многим" с бронированиями
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Связь "многие к одному" с отелями
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
