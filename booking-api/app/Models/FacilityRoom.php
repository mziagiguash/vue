<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityRoom extends Model
{
    use HasFactory;

    protected $table = 'facility_room'; // Указываем таблицу, так как это сводная таблица

    protected $fillable = [
        'facility_id',
        'room_id',
    ];

    // Связь с удобствами
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    // Связь с номером
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
