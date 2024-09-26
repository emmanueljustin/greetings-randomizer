<?php

namespace App\Repositories\AuthRepository;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;

interface IAuthRepository
{
  public function getUser() : JsonResponse;
  public function attempt(array $payload) : array;
  public function create(array $payload) : array;
  public function generateToken(User | Authenticatable $user) : string;
  public function revokeToken() : bool;
  public function refreshToken() : string;
}