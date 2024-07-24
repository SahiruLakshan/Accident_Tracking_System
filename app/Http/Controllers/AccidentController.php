<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Carbon\Carbon;
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

    public function home()
    {
        $currentYear = Carbon::now()->year;

        $monthlyAccidentCounts = Data::selectRaw('MONTH(date) as month, COUNT(*) as count')
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyCounts = array_fill(1, 12, 0);
        foreach ($monthlyAccidentCounts as $month => $count) {
            $monthlyCounts[$month] = $count;
        }

        // Weekly accident counts for the current week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $weeklyAccidentCounts = Data::selectRaw('DAYOFWEEK(date) as day, COUNT(*) as count')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('count', 'day')
            ->toArray();

        $weeklyCounts = array_fill(1, 7, 0); 
        foreach ($weeklyAccidentCounts as $day => $count) {
            $weeklyCounts[$day] = $count;
        }

        return view('Admin.home', ['monthlyCounts' => $monthlyCounts,
        'weeklyCounts' => $weeklyCounts]);
    }
}
