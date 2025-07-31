<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //index dfetch all users
    public function index()
    {
        $users = User::latest()->paginate(10);

        $data = [
            'status' => true,
            'message' => 'All users fetched successfully',
            'data' => $users,
        ];

        return response()->json($data, 200);
    }


    // show a single user
    public function fetchSingleUser($id)
    {
        // validate Id is required
        if (!$id) {
            return response()->json([
                'status' => false,
                'message' => 'User ID is required',
            ], 400);
        }

        // validate id is numeric
        if (!is_numeric($id)) {
            return response()->json([
                'status' => false,
                'message' => 'User ID must be a number',
            ], 400);
        }

        // validate id
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);
        }

        $data = [
            'status' => true,
            'message' => 'User fetched successfully',
            'data' => $user,
        ];

        return response()->json($data, 200);
    }

    // create user
    public function create(Request $request)
    {


        // validate request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'data' => [],
                'errors' => $validator->errors(),
            ], 422);
        }

        // create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $data = [
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ];

        return response()->json($data, 201);
    }
}
