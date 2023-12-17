<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    protected $table = 'tools';

    protected $fillable = ['name_tool'];

    use HasFactory;
}
