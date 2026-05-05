<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->merge([
            'name' => strtolower($request->name),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'min:10', 'unique:students,name'],
            'age' => ['required', 'integer',],
            'address' => ['required',],
            'group' => ['required'],
        ]);

        $validated['name'] = strtolower($validated['name']);

        Student::create($validated);

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {

        $request->merge([
            'name' => strtolower($request->name),
        ]);

        $validated = $request->validate([
            'name' => ['required', 'min:10', 'unique:students,name'],
            'age' => ['required', 'integer'],
            'address' => ['required'],
            'group' => ['required'],
        ]);

        $validated['name'] = strtolower($validated['name']);

        $student->update($validated);

        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('/students');
    }
}
