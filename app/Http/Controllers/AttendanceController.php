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
    public function index()
    {
        $students = Student::all();
        return view('attendances.index', compact('students'));
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
            'present' => ['required', 'boolean']

        ]);

        Attendance::create([
            'student_id' => $validated['student_id'],
            'user_id' => Auth::id(),
            'date' => today(),
            'present' => $validated['present']
        ]);

        $student_id = $validated['student_id'];

        return redirect('/attendances/' . $student_id );
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        $alreadyMarked = $student->attendances()
        ->whereDate('date', now()->toDateString())
        ->exists();

        $attendanceHistory = $student->attendances()
        ->with('user')
        ->orderBy('date', 'desc')
        ->get();

        return view('attendances.show', compact('student', 'attendanceHistory', 'alreadyMarked'));
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
