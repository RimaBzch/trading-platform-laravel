<?php

namespace App\Http\Controllers;

use App\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::all();

        return view('tools.index', compact('tools'));
    }
}
