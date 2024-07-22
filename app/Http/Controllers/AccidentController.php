<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    public function getdata(Request $request)
    {
        $selectedYear = $request->input('year', date('Y')); // Default to the current year if no year is selected

        $data = Data::whereYear('date', $selectedYear)->get(); // Assuming 'date' is the name of your date column

        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json(['data' => $data]);
        }

        return view('Admin.accidents', compact('data', 'selectedYear'));
    }
}
