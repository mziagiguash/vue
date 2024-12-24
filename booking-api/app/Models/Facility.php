<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'facility_hotel');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'facility_room');
    }
}
