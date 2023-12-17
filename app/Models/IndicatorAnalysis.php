<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class IndicatorAnalysis extends Model
{use HasFactory;

    protected $table = 'indicator_analyses';

    protected $fillable = [
        'tool_id',
        'pair_id',
        'm1',
        'm5',
        'm15',
        'm30',
        'h1',
        'h2',
        'h4',
        'h6',
        'h8',
        'h12',
        'd1',
        'w1',
        'mn',
        'm1_current',
        'm5_current',
        'm15_current',
        'm30_current',
        'h1_current',
        'h2_current',
        'h4_current',
        'h6_current',
        'h8_current',
        'h12_current',
        'd1_current',
        'w1_current',
        'mn_current',
        'm1_last_closed_bar',
        'm5_last_closed_bar',
        'm15_last_closed_bar',
        'm30_last_closed_bar',
        'h1_last_closed_bar',
        'h2_last_closed_bar',
        'h4_last_closed_bar',
        'h6_last_closed_bar',
        'h8_last_closed_bar',
        'h12_last_closed_bar',
        'd1_last_closed_bar',
        'w1_last_closed_bar',
        'mn_last_closed_bar',
        'm1_fl_current',
        'm5_fl_current',
        'm15_fl_current',
        'm30_fl_current',
        'h1_fl_current',
        'h2_fl_current',
        'h4_fl_current',
        'h6_fl_current',
        'h8_fl_current',
        'h12_fl_current',
        'd1_fl_current',
        'w1_fl_current',
        'mn_fl_current',
        'm1_fl_last_closed_bar',
        'm5_fl_last_closed_bar',
        'm15_fl_last_closed_bar',
        'm30_fl_last_closed_bar',
        'h1_fl_last_closed_bar',
        'h2_fl_last_closed_bar',
        'h4_fl_last_closed_bar',
        'h6_fl_last_closed_bar',
        'h8_fl_last_closed_bar',
        'h12_fl_last_closed_bar',
        'd1_fl_last_closed_bar',
        'w1_fl_last_closed_bar',
        'mn_fl_last_closed_bar',
        'm1_sl_current',
        'm5_sl_current',
        'm15_sl_current',
        'm30_sl_current',
        'h1_sl_current',
        'h2_sl_current',
        'h4_sl_current',
        'h6_sl_current',
        'h8_sl_current',
        'd1_sl_current',
        'w1_sl_current',
        'mn_sl_current',
        'm1_sl_last_closed_bar',
        'm5_sl_last_closed_bar',
        'm15_sl_last_closed_bar',
        'm30_sl_last_closed_bar',
        'h1_sl_last_closed_bar',
        'h2_sl_last_closed_bar',
        'h4_sl_last_closed_bar',
        'h6_sl_last_closed_bar',
        'h8_sl_last_closed_bar',
        'd1_sl_last_closed_bar',
        'w1_sl_last_closed_bar',
        'mn_sl_last_closed_bar',

        'type_analyse',
    ];
    // protected static function boot()
    // {
    //     parent::boot();


    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function pair()
    {
        return $this->belongsTo(Pair::class);

    }

}
