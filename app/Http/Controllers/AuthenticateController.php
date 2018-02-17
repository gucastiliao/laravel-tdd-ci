<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception;

class AuthenticateController extends Controller
{
    /**
    *  API Login, on success return JWT Auth token
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'create token error'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
    * Log out
    * Invalidate the token, so user cannot use it anymore
    * They have to relogin to get a new token
    *
    * @param Request $request
    */
    public function logout(Request $request)
    {
        $this->validate(
            $request,
            [
                'token' => 'required'
            ]
        );

        JWTAuth::invalidate($request->input('token'));
    }

    /**
     * Returns the authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticatedUser()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        return response()->json(compact('user'));
    }

    /**
    * Refresh the token
    *
    * @return mixed
    */
    public function refreshToken()
    {
        $token = JWTAuth::getToken();

        if (!$token) {
            throw new Exception\MethodNotAllowedHttpException([], 'Token not provided');
        }

        try {
            $refreshedToken = JWTAuth::refresh($token);
        } catch (JWTException $e) {
            return response()->json(
                [
                    'refreshed' => false,
                    'message' => 'Not able to refresh token'
                ],
                422
            );
        }

        return response()->json(
            [
                'refreshed' => true,
                'token' => $refreshedToken
            ]
        );
    }
}
