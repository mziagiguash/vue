<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityHotel extends Model
{
    use HasFactory;

    protected $table = 'facility_hotel'; // Указываем таблицу, так как это сводная таблица

    protected $fillable = [
        'facility_id',
        'hotel_id',
    ];

    // Связь с удобствами
    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    // Связь с отелем
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}

