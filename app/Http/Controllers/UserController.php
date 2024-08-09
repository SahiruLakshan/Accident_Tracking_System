<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User; // Ensure this path matches your actual User model location
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        Log::info('User registration request received.');

        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            Log::error('Validation failed for user registration.', ['errors' => $validator->errors()]);
            return response()->json(['message' => 'Validation failed.', 'errors' => $validator->errors()], 400);
        }

        try {
            // Create a new user record with incoming request data
            $user = User::create([
                'name' => $request->input('name'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            // Log success message
            Log::info('User registered successfully', ['user_id' => $user->id]);

            // Return a success response
            return response()->json(['message' => 'User registered successfully'], 201);

        } catch (\Exception $e) {
            // Log error message
            Log::error('Failed to register user: ' . $e->getMessage());

            // Return an error response
            return response()->json(['message' => 'Failed to register user. Please try again.'], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            Log::info('Login request received.', ['email' => $request->input('email')]);

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed for login request.', ['errors' => $validator->errors()]);
                return response()->json(['error' => 'Validation failed', 'message' => $validator->errors()], 422);
            }

            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $user = Auth::user();
                Log::info('User logged in successfully.', ['user_id' => $user->id]);
               

                return response()->json([
                    'userId' => $user->id,
                   
                ], 200);
            } else {
                Log::warning('Login attempt failed for email: ' . $request->input('email'));
                return response()->json(['error' => 'Unauthorized', 'message' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred during login.', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error', 'message' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }



}
