<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccidentController extends Controller
{

    public function store(Request $request)
    {
        // Log the incoming request data
        Log::info('Incoming request data:', $request->all());

        try {
            // Handle file uploads (images)
            $imagePaths = [];
            foreach ($request->file('accident_images') as $image) {
                $filename = $image->getClientOriginalName();
                // Store the image in the desired directory
                $path = $image->storeAs('public/AC_images', $filename);
                // Store only the filename in the array
                $imagePaths[] = $filename;
            }

            Log::info('Data get');
            // Create new data entry
            $data = new Data();
            $data->user_id = $request->input('user_id');
            $data->se_no = $request->input('se_no');
            $data->lat = $request->input('latitude');
            $data->lon = $request->input('longitude');
            $data->date = $request->input('date');
            $data->time = $request->input('time');
            $data->acd_type = $request->input('accident_type');
            $data->severity = $request->input('severity');
            $data->weather = $request->input('weather');
            $data->vehicle_1 = $request->input('vehicle_type_1');
            $data->vehicle_2 = $request->input('vehicle_type_2');
            $data->vehicle_3 = $request->input('vehicle_type_3');
            $data->pedest = $request->input('object_type');
            $data->object = $request->input('object_type');
            $data->with_con = $request->input('property_damage');
            $data->pas_inj = $request->input('passenger_injured') === 'true'; // Convert to boolean
            $data->male_passengers = $request->input('male_passengers');
            $data->female_passengers = $request->input('female_passengers');
            $data->ped_inj = $request->input('pedestrian_injured') === 'true'; // Convert to boolean
            $data->male_pedestrian = $request->input('male_pedestrian');
            $data->female_pedestrian = $request->input('female_pedestrian');
            $data->children_injured = $request->input('children_injured') === 'true'; // Convert to boolean
            $data->children_count = $request->input('children_count');
            $data->des = $request->input('description');
            $data->drunkness = $request->input('driver_drank') === 'true'; // Convert to boolean
            $data->remarks = $request->input('remarks');
            $data->images = json_encode($imagePaths); // Store image URLs as JSON array
            $data->save();

            // Log successful save
            Log::info('Data saved successfully:', $data->toArray());

            return response()->json(['message' => 'Data saved successfully'], 200);
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Failed to save data:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to save data: ' . $e->getMessage()], 500);
        }
    }


    public function getdata(Request $request)
    {
        $selectedYear = $request->input('year', date('Y'));

        $data = Data::whereYear('date', $selectedYear)->orderBy('date', 'desc')->get();

        if ($request->ajax()) {
            return response()->json(['data' => $data]);
        }


        return view('Admin.accidents', compact('data', 'selectedYear'));
    }

    public function map()
    {
        $currentYear = Carbon::now()->year;

        $locations = Data::whereYear('date', $currentYear)->get();
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
            'timeRangeCounts' => $timeRangeCounts,
        ]);
    }

    public function info()
    {
        $severityCounts = Data::select('Severity', DB::raw('count(*) as count'))
            ->whereYear('date', date('Y'))
            ->groupBy('Severity')
            ->get();

        $yearlyData = DB::table('data')
            ->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('count(*) as accident_count'),
                DB::raw('sum(male_passengers + female_passengers) as passanger_injuries'),
                DB::raw('sum(male_pedestrian + female_pedestrian) as pedestrian_injuries'),
                DB::raw('sum(children_count) as children_injuries'),
                DB::raw('sum(male_passengers + female_passengers + male_pedestrian + female_pedestrian + children_count) as total_injuries'),
            )
            ->whereYear('date', '>=', Carbon::now()->subYears(5)->year) // Get data starting from 5 years ago
            ->whereYear('date', '<=', date('Y')) // Get data up to the last year
            ->groupBy(DB::raw('YEAR(date)'))
            ->orderBy('year', 'desc') // Order by year in descending order
            ->get();

        return view('Admin.info', compact('severityCounts', 'yearlyData'));
    }

    public function accidentremove($id)
    {
        $accident = Data::find($id);
        $accident->delete();
        return redirect()->back()->with('success', 'Accident Deleted.');
    }

    public function searchReports(Request $request)
    {
        $searchTerm = $request->search;

        $data = Data::where('se_no', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('date', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('time', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function form($id)
    {
        $data = Data::find($id);
        return view('Admin.update', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Data::findOrFail($id);

        // Update the record with the new data
        $data->update($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Accident Updated Successfully.');
    }
}
