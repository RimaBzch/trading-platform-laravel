<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pair extends Model
{
    protected $table = 'pairs';

    protected $fillable = ['pair_name'];
    
    use HasFactory;

}
