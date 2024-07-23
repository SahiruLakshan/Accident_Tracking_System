<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    public function getdata(Request $request)
    {
        $selectedYear = $request->input('year', date('Y')); 

        $data = Data::whereYear('date', $selectedYear)->get();

        if ($request->ajax()) {
            return response()->json(['data' => $data]);
        }

        return view('Admin.accidents', compact('data', 'selectedYear'));
    }

    public function map()
    {
        $locations = Data::all(); 
        
        return view('Admin.map', ['locations' => $locations]);
    }
}
