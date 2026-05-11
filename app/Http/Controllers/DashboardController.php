<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalStudent = Student::count();

        $avgAge = Student::avg('age') ?? 0;

        $locationData = Student::query()
            ->select('address')
            ->selectRaw('count(*) as total')
            ->groupBy('address')
            ->get();

        $locationLabels = $locationData->pluck('address')->values();

        $locationCounts = $locationData->pluck('total')->values();

        $maleGender = Student::where('gender', 'Male')->count();
        $femaleGender = Student::where('gender', 'Female')->count();

        $presentCount = Attendance::where('present', 1)->count();
        $absentCount = Attendance::where('present', 0)->count();

        $groupAttendance = Attendance::query()
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->selectRaw('students."group" as student_group')
            ->selectRaw('SUM(CASE WHEN attendances.present = 1 THEN 1 ELSE 0 END) as present_count')
            ->selectRaw('SUM(CASE WHEN attendances.present = 0 THEN 1 ELSE 0 END) as absent_count')
            ->groupByRaw('students."group"')
            ->get();

        $groupLabels = $groupAttendance->pluck('student_group')->values();
        $groupPresent = $groupAttendance->pluck('present_count')->values();
        $groupAbsent = $groupAttendance->pluck('absent_count')->values();

        $dailyAttendance = Attendance::query()
            ->select('date')
            ->selectRaw('SUM(CASE WHEN present = 1 THEN 1 ELSE 0 END) as present_count')
            ->selectRaw('SUM(CASE WHEN present = 0 THEN 1 ELSE 0 END) as absent_count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dailyLabels = $dailyAttendance
            ->map(fn ($item) => Carbon::parse($item->date)->format('M d'))
            ->values();
        $dailyPresent = $dailyAttendance->pluck('present_count')->values();
        $dailyAbsent = $dailyAttendance->pluck('absent_count')->values();

        $perfectAttendanceCount = Student::whereDoesntHave('attendances', function ($query) {
            $query->where('present', 0);
        })->count();

        $presentToday = Attendance::where('present', 1)->whereDate('date', today())->count();

        $alreadyYouth = Student::where('age', '>=', 13)->count();
        $turningYouth = Student::where('age', '=', 12)->count();






        return view('dashboard', compact(
            'locationLabels',
            'locationCounts',
            'presentCount',
            'absentCount',
            'totalStudent',
            'avgAge',
            'maleGender',
            'femaleGender',
            'groupLabels',
            'groupPresent',
            'groupAbsent',
            'dailyLabels',
            'dailyPresent',
            'dailyAbsent',
            'perfectAttendanceCount',
            'presentToday',
            'alreadyYouth',
            'turningYouth'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
