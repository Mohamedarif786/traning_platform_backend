<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return response()->json([
            'success' => true,
            'message' => 'Courses retrieved successfully',
            'data' => $courses,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_description' => 'nullable|string',
        ]);

        $course = Course::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Course created successfully',
            'data' => $course,
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_description' => 'nullable|string',
        ]);

        $course->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Course updated successfully',
            'data' => $course,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::find($id);

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
