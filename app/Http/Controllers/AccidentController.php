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
        $lastYear = $currentYear - 1;
        $currentDate = Carbon::now();
        $yearsRange = range($currentYear - 5, $currentYear - 1);

        $yearlyCounts = [];

        foreach ($yearsRange as $year) {
            // Fetch total accident count for each year
            $yearlyCounts[$year] = Data::whereYear('date', $year)->count();
        }

        $weekOfMonth = ceil($currentDate->day / 7);

        // Monthly accident counts for the current year
        $monthlyAccidentCountsCurrentYear = Data::selectRaw('MONTH(date) as month, COUNT(*) as count')
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyCountsCurrentYear = array_fill(1, 12, 0);
        foreach ($monthlyAccidentCountsCurrentYear as $month => $count) {
            $monthlyCountsCurrentYear[$month] = $count;
        }

        // Monthly accident counts for the last year
        $monthlyAccidentCountsLastYear = Data::selectRaw('MONTH(date) as month, COUNT(*) as count')
            ->whereYear('date', $lastYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyCountsLastYear = array_fill(1, 12, 0);
        foreach ($monthlyAccidentCountsLastYear as $month => $count) {
            $monthlyCountsLastYear[$month] = $count;
        }

        // Calculate total accidents for each year
        $totalCurrentYear = array_sum($monthlyCountsCurrentYear);
        $totalLastYear = array_sum($monthlyCountsLastYear);

        // Calculate percentage change for the current year
        $percentageChange = $totalLastYear > 0 ? (($totalCurrentYear - $totalLastYear) / $totalLastYear) * 100 : 0;

        // Get the last updated timestamp
        $lastUpdated = Data::latest('updated_at')->first();
        $updatedAt = $lastUpdated ? $lastUpdated->updated_at : Carbon::now();
        $formattedUpdatedAt = Carbon::parse($updatedAt)->format('F j, Y h:i A'); // Format: January 1, 2024 12:00 PM
        $timeSinceUpdate = Carbon::parse($updatedAt)->diffForHumans();

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

        // Calculate today's and yesterday's accident counts
        $todayCount = Data::whereDate('date', $currentDate)->count();
        $yesterdayCount = Data::whereDate('date', $currentDate->copy()->subDay())->count();

        // Calculate percentage change from yesterday to today
        $percentageChangeTodayYesterday = $yesterdayCount > 0 ? (($todayCount - $yesterdayCount) / $yesterdayCount) * 100 : 0;

        // Accident counts for specified time ranges this year
        $timeRanges = [
            '00:00 - 06:00' => ['00:00:00', '05:59:59'],
            '06:00 - 12:00' => ['06:00:00', '11:59:59'],
            '12:00 - 18:00' => ['12:00:00', '17:59:59'],
            '18:00 - 00:00' => ['18:00:00', '23:59:59'],
        ];

        $timeRangeCounts = [];
        foreach ($timeRanges as $label => $range) {
            $timeRangeCounts[$label] = Data::whereYear('date', $currentYear)
                ->whereTime('time', '>=', $range[0])
                ->whereTime('time', '<=', $range[1])
                ->count();
        }

        return view('Admin.home', [
            'monthlyCountsCurrentYear' => $monthlyCountsCurrentYear,
            'totalCurrentYear' => $totalCurrentYear,
            'percentageChange' => $percentageChange,
            'formattedUpdatedAt' => $formattedUpdatedAt,
            'timeSinceUpdate' => $timeSinceUpdate,
            'weeklyCounts' => $weeklyCounts,
            'weekOfMonth' => $weekOfMonth,
            'yearlyCounts' => $yearlyCounts,
            'percentageChangeTodayYesterday' => $percentageChangeTodayYesterday,
            'timeRangeCounts' => $timeRangeCounts, // Pass to view
        ]);
    }
}
