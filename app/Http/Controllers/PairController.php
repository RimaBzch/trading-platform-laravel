<?php

namespace App\Http\Controllers;


use App\Models\Pair;
use App\Models\IndicatorAnalysis;
use App\Models\PairRisk;
use App\Models\Tool;

use Illuminate\Http\Request;

class PairController extends Controller
{
    public function index()
    {
        $pairs = PairRisk::all();

        return view('calculator.forex-calculation', compact('pairs'));
    }
}
