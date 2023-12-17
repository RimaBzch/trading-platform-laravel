<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PairRisk extends Model
{
    protected $table = 'pairs_risk';

    protected $fillable = [
        'symbol',
        'description',
        'swap_short',
        'swap_long',
        'tick_value',
        'tick_size',
        'daily_open_price',
        'daily_close_price',
        'daily_high_price',
        'daily_low_price',
        'daily_volume',
        'daily_change_percentage',
    ];
}
