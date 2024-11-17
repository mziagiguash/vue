<?php

// app/Models/Facility.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * Связь с отелями через таблицу facility_hotel.
     */
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'facility_hotel');
    }

    /**
     * Связь с номерами через таблицу facility_room.
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'facility_room');
    }
}
