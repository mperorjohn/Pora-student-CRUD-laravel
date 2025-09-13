<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;


// import validator
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    // index
    public function index(){

        // method_mapping
        // $test = UserController::class;
        // fetching all the students in the the students table

        // $students = Student::all();

        // fetch with trashed
        // $students = Student::withTrashed()->get();

        // fetch  and paginate
        // $students = Student::paginate(10);


        // fetch latest and paginate
        $students = Student::latest()->paginate(10);


        $data  = [
            'status' => true,
            'message' => 'All students fetched successfully',
            'data'=> $students,
        ];


        return response()->json($data, 200);


    }


    public function show($id){

        // validate Id is required
        if(!$id){
            return response()->json([
                'status'=>false,
                'message'=>'Student ID is required',
            ], 400);
        }


        // validate id

        if(!is_numeric($id)){
            return response()->json([
                'status'=>false,
                'message'=>'Student ID must be a number',
                'data' => []
            ], 400);
        }

        // fetching the student with the given id
        $student = Student::find($id);

        // if student is not found
        if(!$student){
            return response()->json([
                'status'=>false,
                'message'=>'The student you are looking for does not exist',
            ], 404);
        }
        $data = [
            'status' => true,
            'message' => 'Student fetched successfully',
            'data' => $student,
        ];

        return response()->json($data, 200);

    }


    // store
    public function store(Request $request)
    {

        // validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'age' => 'required|string|max:6',
            'state_of_origin' => 'required|string|max:255',
            'class' => 'required|string|max:255',
        ]);



        // // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        // create a new student
        $student = Student::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student,
        ], 201);


    }


    // update
    public function update(Request $request, $id)
    {
        // validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|string|max:6',
            'state_of_origin' => 'sometimes|required|string|max:255',
            'class' => 'sometimes|required|string|max:255',
        ]);

        // if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        // find the student by id
        $student = Student::find($id);

        // if student is not found
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
            ], 404);
        }

        // update the student
        $student->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Student updated successfully',
            'data' => $student,
        ], 200);
    }


    // delete
    public function destroy($id)
    {
        // find the student by id
        $student = Student::find($id);

        // if student is not found
        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
            ], 404);
        }

        // delete the student
        $student->delete();

        return response()->json([
            'status' => true,
            'message' => 'Student deleted successfully',
        ], 200);
    }







}
