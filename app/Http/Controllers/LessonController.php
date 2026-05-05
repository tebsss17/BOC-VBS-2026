<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::all();
        return view('lessons.index', ['lessons'=> $lessons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lessons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day' => ['required', 'integer'],
            'title' => ['required', 'min:3'],
            'description' => ['required'],
            'memory_verse' => ['required'],
        ]);

        Lesson::create($validated);

        return redirect('/lessons');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        return view('lessons.edit', ['lesson' => $lesson]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'day' => ['required', 'integer'],
            'title' => ['required', 'min:3'],
            'description' => ['required'],
            'memory_verse' => ['required'],
        ]);

        $lesson->update($validated);

        return redirect('/lessons');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect('/lessons');
    }
}
