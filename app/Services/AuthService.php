<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository\AuthRepository;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;

class AuthService
{
  protected $repo;

  /**
   * Constructor for [AuthRepository] class.
   */
  public function __construct(AuthRepository $repo)
  {
    $this->repo = $repo;
  }

  /**
   * Accesses the method [getUser] inside AuthRepository.
   */
  public function getUser() : JsonResponse
  {
    return $this->repo->getUser();
  }

  /**
   * Accesses the method [attempt] inside AuthRepository.
   */
  public function attempt(array $payload) : array
  {
    return $this->repo->attempt($payload);
  }

  /**
   * Accesses the method [create] inside AuthRepository.
   */
  public function create(array $payload) : array
  {
    return $this->repo->create($payload);
  }

  /**
   * Accesses the method [createToken] inside AuthRepository.
   */
  public function generateToken(User | Authenticatable $user) : string
  {
    return $this->repo->generateToken($user);
  }

  /**
   * Accesses the method [revokeToken] inside AuthRepository.
   */
  public function revokeToken() : bool
  {
    return $this->repo->revokeToken();
  }

  /**
   * Accesses the method [refreshToken] inside AuthRepository.
   */
  public function refreshToken() : string
  {
    return $this->repo->refreshToken();
  }
}
