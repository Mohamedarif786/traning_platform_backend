<?php

namespace App\Http\Controllers;

use App\Models\OptIn;
use Illuminate\Http\Request;

class OptInController extends Controller
{
    //
    public function optIn(Request $request){

        $validatedData = $request->validate([
            'student_id' => 'required',
            'schedule_id' => 'required',
            'course_id' => 'required',
        ]);
        

        $optInCheck = OptIn::where('student_id', $request->student_id)
            ->where('schedule_id', $request->schedule_id)
            ->first();

        $response_data = [];            
        if($optInCheck == null){
            $optIn = OptIn::create($validatedData);
            $response_data = [
                'success' => true,
                'message' => 'Punch In Successfully',
                'data' => $optIn,
            ];
        }else{
            $response_data = [
                'success' => false,
                'message' => 'Already your Punch In this course',
                'data' => "",
            ];
        }
        
        return response()->json($response_data, 201);
    }


    public function optOut(Request $request)
    {
        $optIn = OptIn::where('student_id', $request->student_id)
            ->where('schedule_id', $request->schedule_id)
            ->first();

        $response_data = [];    
        if ($optIn) {
            $optIn->delete();
            $response_data = [
                'success' => true,
                'message' => 'Punch Out Successfully',
            ];
        }else{
            $response_data = [
                'success' => false,
                'message' => 'Record not found or Your not punch In this course',
            ]; 
        }

        return response()->json($response_data);
    }

    public function getAllActiveStudent (Request $request){
        $getAllActiveStudent = OptIn::with('course','student')->get();
        return response()->json([
            'success' => true,
            'message' => 'getAllActiveStudent retrieved successfully',
            'data' => $getAllActiveStudent,
        ], 200);
    }
}
