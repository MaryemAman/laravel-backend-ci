<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * @group Authentication
 */
class AuthenticationController extends Controller
{
    /**
     * Login
     *
     * Authenticates with the DB and returns the user, token and roles
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
    $user = User::where(['username' => $request->post('username')])->first();

    if (empty($user)) {
        return response()->json([
            'logged_in' => false,
            'status' => "Invalid username",
            'errors' => null
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    if (!Hash::check($request->post('password'), $user->password)) {
        return response()->json([
            'logged_in' => false,
            'status' => "Invalid password",
            'errors' => null
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $token = $user->createToken("auth");

    return response()->json([
        'logged_in' => true,
        'status' => 'Login successful',
        'token' => $token->plainTextToken,
        'user' => $user
    ], Response::HTTP_OK);
}

    /**
     * Logout
     *
     * Destroys the session and invalidates the token
     * @authenticated
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $user = \request()->user();
        $user->currentAccessToken()->delete();


        return response()->json(null, Response::HTTP_OK);
    }

    /**
     * Get User
     *
     * Returns details of the currently logged in user
     * @authenticated
     * @return mixed
     */
    public function getUser()
    {
        return \request()->user();
    }

    /**
     * Reset Password
     *
     * Resets the user password to the given password
     * @authenticated
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ["required", "string", "confirmed"]
        ]);

        $password = $request->post('password');
        $user->password = bcrypt($password);
        $user->save();

        //todo -- notify user of password reset

        return response()->json(null, Response::HTTP_OK);
    }

}
