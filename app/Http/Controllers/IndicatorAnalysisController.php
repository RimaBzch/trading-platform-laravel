<?php

namespace App\Http\Controllers;

use App\Events\IndicatorAnalysisUpdated;
use App\Jobs\CheckTableChanges;
use App\Models\IndicatorAnalysis;
use App\Models\Pair;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;


class IndicatorAnalysisController extends Controller
{
    public function index(Request $request, $toolId)
    {
        $indicatorAnalyses = IndicatorAnalysis::where('tool_id', $toolId)->get();

        $tools = Tool::all();
//        $pairs = $request->input('pairs', []);
//        $selectedTimeframes = $request->input('timeframes', []);
//        $timeframes = [];
//        foreach ($selectedTimeframes as $timeframe) {
//            $timeframes[] = strtoupper($timeframe);
//        }
//        $seuil=$request->input('seuil');
////        dd($seuil);
        $user = Auth::user();

        // Récupérer les valeurs enregistrées dans la base de données ou définir des valeurs par défaut
        $pairs = json_decode($user->selected_pairs, true);
        $timeframes = json_decode($user->selected_timeframes, true);
        $seuil = $user->selected_threshold ;
        return view('index')->with(compact('indicatorAnalyses', 'pairs', 'tools', 'toolId', 'timeframes' ,'seuil' ));

    }
    public function update(Request $request, $indicatorAnalysisId )
    {
        $indicatorAnalysis = IndicatorAnalysis::findOrFail($indicatorAnalysisId);
        $validatedData = $request->validate([
            'tool_id' => 'exists:tools,id',
            'pair_id' => 'exists:pairs,id',
            'm1' => 'nullable',
            'm5' => 'nullable',
            'm15' => 'nullable',
            'm30' => 'nullable',
            'h1' => 'nullable',
            'h2' => 'nullable',
            'h4' => 'nullable',
            'h6' => 'nullable',
            'h8' => 'nullable',
            'h12' => 'nullable',
            'd1' => 'nullable',
            'w1' => 'nullable',
            'mn' => 'nullable',
            'pairs' => 'array',
            'timeframes' => 'array',
            'seuil' => 'numeric'
            // Inclure les règles de validation pour les autres champs que vous souhaitez mettre à jour
        ]);

        $previousValues = $indicatorAnalysis->getAttributes();
        $indicatorAnalysis->update($validatedData);
        IndicatorAnalysisUpdated::dispatch($indicatorAnalysis, $previousValues);


        $seuil = $request->input('seuil');
        $selectedPairs = $request->input('pairs');
        $selectedTimeframes = $request->input('timeframes');
        $selectedPairs = $request->input('pairs');
        $pairs = [];

        foreach ($selectedPairs as $pair) {
            $pairData = json_decode($pair, true);
            $pairName = $pairData['pair_name'];
            $pairs[] = $pairName;
        }

        $user = Auth::user();
        $user->selected_pairs = json_encode($pairs);
        $user->selected_timeframes = json_encode($selectedTimeframes);
        $user->selected_threshold = $seuil;
        $user->save();

//        return response()->json(['message' => 'Indicator analysis updated successfully', 'data' => $indicatorAnalysis]);
        return redirect()->route('datatable.index', ['tool_id' => 1]);

    }

}
