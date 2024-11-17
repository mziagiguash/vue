<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    protected $fillable = ['title'];

    // Связь с отелями
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'facility_hotel', 'facility_id', 'hotel_id');
    }

    // Связь с номерами
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'facility_room', 'facility_id', 'room_id');
    }
}
