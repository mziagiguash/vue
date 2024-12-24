<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class HotelFilter extends AbstractFilter
{
    public const PRICE_MIN = 'price_min';
    public const PRICE_MAX = 'price_max';
    public const FACILITY = 'facility';

    protected function getCallbacks(): array
    {
        return [
            self::PRICE_MIN => [$this, 'priceMin'],
            self::PRICE_MAX => [$this, 'priceMax'],
            self::FACILITY => [$this, 'facility'],
        ];
    }

    public function priceMin(Builder $builder, $value)
    {
        $builder->whereHas('rooms', function ($b) use ($value) {
            $b->where('price', '>=', $value);
        });
    }

    public function priceMax(Builder $builder, $value)
    {
        $builder->whereHas('rooms', function ($b) use ($value) {
            $b->where('price', '<=', $value);
        });
    }

    public function facility(Builder $builder, $values)
    {
        foreach ($values as $value) {
                $builder->whereHas('facilities', function ($b) use ($value) {
                    $b->where('facility_id', '=', $value);
            });
        }
    }
}
