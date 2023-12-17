<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VWAPController extends Controller
{
    public function index()
    {
        return view('calculator.vwapcalculator');
    }

    public function calculateVWAP(Request $request)
    {

        $price = $request->input('price');
        $volume = $request->input('volume');
        $totalVolume = $request->input('total_volume');
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');


        $vwap = ($price * $volume) / $totalVolume;


        return view('calculator.vwapcalculator', ['vwap' => $vwap]);
    }
}
