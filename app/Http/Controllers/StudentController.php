<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Student::all();
        return response()->json([
            'success' => true,
            'message' => 'student retrieved successfully',
            'data' => $courses,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|string',
        ]);

        $course = Student::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'student created successfully',
            'data' => $course,
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Student::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'student not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|string',
        ]);

        $course->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'student updated successfully',
            'data' => $course,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Student::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'student not found',
            ], 404);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'student deleted successfully',
        ], 200);
    }
}
