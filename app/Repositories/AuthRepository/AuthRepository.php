<?php

namespace App\Repositories\AuthRepository;

use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements IAuthRepository
{

  /**
   * Fetches an existing user based on the token provided.
   */
  public function getUser() : JsonResponse
  {
    $user = Auth::user();

    if (!$user) {
      return response()->json([
        'status' => 'err',
        'message' => 'User not found.',
      ], 404);
    }

    return response()->json([
      'status' => 'ok',
      'message' => 'Here is your requested user data.',
      'data' => $user,
    ]);
  }

  /**
   * Attempt to check if the user aleady exists.
   */
  public function attempt(array $payload) : array
  {
    if (Auth::attempt($payload)) {
      $existingUser = Auth::user();

      $token = $this->generateToken($existingUser);

      $result = [
        'status' => 'ok',
        'message' => 'Successfully logged in.',
        'data' => [
          'token' => "Bearer {$token}",
          'userData' => $existingUser,
        ],
      ];

      return $result;
    }

    $result = [
      'status' => 'ok',
      'message' => 'No existing user found.'
    ];
    return $result;
  }

  /**
   * Create user and save it to database.
   */
  public function create(array $payload) : array
  {
    $user = User::create($payload);

    $token = $this->generateToken($user);

    $data = [
      'status' => 'ok',
      'messsage' => 'Created account succesfully.',
      'data' => [
        'token' => "Bearer {$token}",
        'userData' => $user,
      ],
    ];

    return $data;
  }

  /**
   * Generate a token for user data.
   */
  public function generateToken(User | Authenticatable $user) : string
  {
    $token = $user->createToken('access-token')->accessToken;
    return $token;
  }

  /**
   * Revoke token access when logging out.
   */
  public function revokeToken() : bool
  {
    return auth()->user()->token()->revoke();
  }

  /**
   * Refreshes the expired token once detected that it is no longer usable.
   */
  public function refreshToken() : string
  {
    $user = Auth::user();

    $token = $this->generateToken($user);

    return $token;
  }
}