<?php
namespace App\Http\Controllers;
use App\Models\PairRisk;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{

            public function calculate(Request $request)
            {
                // Perform calculations
                $currencyPairId = $request->input('currency_pair');
                $accountCurrency = $request->input('account_currency');
                $accountSize = $request->input('account_size');
                $riskRatio = $request->input('risk_ratio');
                $stopLossPips = $request->input('stop_loss_pips');
                $tradeSize = $request->input('trade_size');
                $pairRisk = PairRisk::where('id', $currencyPairId)->first();
                //dd($pairRisk , $currencyPairId);
        //        if ($pairRisk) {
                    $tickSize = $pairRisk->tick_size;
                    $tickValue = $pairRisk->tick_value;
                    $exchangeRate = $pairRisk->daily_change_percentage;
        //        } else {
        //            $tickSize = 0.0001;
        //            $tickValue = 10;
        //            $exchangeRate = 1;
        //        }
        
        
        
        
                $calculatedMoney = ($riskRatio / 100) * $accountSize ;
                $units = $calculatedMoney * $exchangeRate/ ($stopLossPips * $tickValue );
        
        
                if ($tradeSize >= 1.0) {
                    $volume = 100000;
                } elseif ($tradeSize >= 0.1) {
                    $volume = 10000;
                } elseif ($tradeSize >= 0.01) {
                    $volume = 1000;
                } elseif ($tradeSize >= 0.001) {
                    $volume = 100;
                }
        
                $sizing = $units *($tradeSize *$volume * $tickSize);
        
        
                $pairs = PairRisk::all();
        

        return view('calculator.forex-calculation', compact('pairs', 'calculatedMoney', 'units', 'sizing'));

    }
}
