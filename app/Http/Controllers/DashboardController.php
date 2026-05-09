<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalStudent = Student::count();

        $avgAge = Student::avg('age');

        $locationData = Student::select('address')
            ->selectRaw('count(*) as total')
            ->groupBy('address')
            ->get();

        $locationLabels = $locationData->pluck('address');

        $locationCounts = $locationData->pluck('total');

        $maleGender = Student::where('gender', 'Male')->count();
        $femaleGender = Student::where('gender', 'Female')->count();

        $presentCount = Attendance::where('present', 1)->count();
        $absentCount = Attendance::where('present', 0)->count();

        $groupAttendance = Attendance::select('students.group')
            ->selectRaw('SUM(CASE WHEN attendances.present = 1 THEN 1 ELSE 0 END) as present_count')
            ->selectRaw('SUM(CASE WHEN attendances.present = 0 THEN 1 ELSE 0 END) as absent_count')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->groupBy('students.group')
            ->get();

        $groupLabels = $groupAttendance->pluck('group');
        $groupPresent = $groupAttendance->pluck('present_count');
        $groupAbsent = $groupAttendance->pluck('absent_count');

        $dailyAttendance = Attendance::select('date')
            ->selectRaw('SUM(CASE WHEN present = 1 THEN 1 ELSE 0 END) as present_count')
            ->selectRaw('SUM(CASE WHEN present = 0 THEN 1 ELSE 0 END) as absent_count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dailyLabels = $dailyAttendance->pluck('date');
        $dailyPresent = $dailyAttendance->pluck('present_count');
        $dailyAbsent = $dailyAttendance->pluck('absent_count');

        $perfectAttendanceCount = Attendance::select('student_id') ->groupBy('student_id') ->havingRaw('SUM(CASE WHEN present = 0 THEN 1 ELSE 0 END) = 0') ->count();

        $presentToday = Attendance::where('present', 1)->whereDate('date', today())->count();





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
            'presentToday'
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
