<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('course')->get();   
        return response()->json([
            'success' => true,
            'message' => 'Courses retrieved successfully',
            'data' => $schedules,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
        ]);

        $course = Schedule::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Shedule created successfully',
            'data' => $course,
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Schedule::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'course_id' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i:s',
        ]);

        $course->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'shedule updated successfully',
            'data' => $course,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Schedule::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found',
            ], 404);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully',
        ], 200);
    }
}
