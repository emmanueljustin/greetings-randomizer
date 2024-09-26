<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    /**
     * Initializes the [AuthService] inside this class to be used in methods.
     */
    public function __construct(AuthService $authservice)
    {
      $this->authService = $authservice;
    }

    /**
     * Returns a user data based on the token provided in the headers.
     */
    public function getUser() : JsonResponse
    {
      $reponse = $this->authService->getUser();

      return $reponse;
    }

    /**
     * Returns a response that contains the user token and user credentials.
     */
    public function login(Request $request) : JsonResponse
    {
      $validatedRequest = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
      ]);

      $response = $this->authService->attempt($validatedRequest);

      return response()->json($response, 200);
    }

    /**
     * Creates an account and registers it inside the database and returns a token with credentials.
     */
    public function register(Request $request) : JsonResponse
    {
      $validatedRequest = $request->validate([
        'email' => 'required|email|unique:authentication,email',
        'username' => 'required|string',
        'password' => 'required|string',
      ]);

      $response = $this->authService->create($validatedRequest);

      return response()->json($response, 200);
    }

    /**
     * Removes the token that is sent by the user through Authorization header.
     */
    public function logout() : JsonResponse
    {
      $result = $this->authService->revokeToken();

      if ($result) {
        return response()->json([
          'status' => 'ok',
          'message' => 'Successfully logged out.',
        ], 200);
      } else {
        return response()->json([
          'status' => 'err',
          'message' => 'Failed to log you out.',
        ]);
      }
    }

    /**
     * Refreshes the token and retyurns it back to the user.
     */
    public function refreshToken() : JsonResponse
    {
      $token = $this->authService->refreshToken();

      return response()->json([
        'status' => 'ok',
        'message' => 'New generated token',
        'data' => [
          'token' => $token,
        ],
      ]);
    }
}
