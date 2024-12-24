<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'title',
        'description',
        'poster_url',
        'address',
        'hotel_id'
    ];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'facility_hotel');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

}
