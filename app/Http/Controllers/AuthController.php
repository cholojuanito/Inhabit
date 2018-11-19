<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        if ($v->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Registration unsuccessful.',
                    'errors' => $v->errors()
                ],
                422
            );
        }

        // Save the user in the db
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Registration successful!'
            ],
            200
        );
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Login successful!'
                ],
                200
            )->header('Authorization', $token);
        }
        return response()->json(
            [
                'status' => 'error',
                'errors' => [
                    'invalid_login' => 'Your credentials do not match our records.',
                ],
                'message' => 'Invalid login credentials'
            ],
            401
        );
    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Logout successful!'
            ],
            200
        );
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Found the user!',
                'data' => [
                    'user' => $user
                ]
            ],
            200
        );
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()->json(
                [
                    'status' => 'successs',
                    'message' => 'Token refresh successful!'
                ],
                200
            )->header('Authorization', $token);
        }
        return response()->json(
            [
                'status' => 'error',
                'message' => 'Token refresh unsuccessful.'
            ],
            401
        );
    }

    private function guard()
    {
        return Auth::guard();
    }
}