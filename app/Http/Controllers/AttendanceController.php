<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student, Request $request)
    {
        $date = $request->date ?? now()->toDateString();

        $students = Student::orderBy('name')->get();

        $markedStudents = Attendance::whereDate('date', $date)
            ->pluck('student_id')
            ->flip();

        return view('attendances.index', compact(
            'students',
            'markedStudents',
            'date'
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
        $validated = $request->validate([
        'student_id' => ['required', 'exists:students,id'],
        'present' => ['required', 'boolean'],
        'date' => ['required', 'date'],
    ]);

        $date = date('Y-m-d', strtotime($validated['date']));

        Attendance::updateOrCreate(
            [
                'student_id' => $validated['student_id'],
                'date' => $date,
            ],
            [
                'user_id' => Auth::id(),
                'present' => $validated['present'],
            ]
        );

        return redirect()->route('attendance.index', [
        'date' => $date
]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student, Request $request)
    {
        $date = $request->date ?? now()->toDateString();

        $alreadyMarked = $student->attendances()
            ->whereDate('date', $date)
            ->exists();

        $attendanceHistory = $student->attendances()
            ->with('user')
            ->orderBy('date', 'desc')
            ->get();

        return view('attendances.show', compact(
            'student',
            'attendanceHistory',
            'alreadyMarked',
            'date'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $student_id = $attendance->student_id;
        $attendance->delete();

        return redirect()->route('attendance.show', $student_id);
    }
}
