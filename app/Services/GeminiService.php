<?php

namespace App\Services;

use App\Repositories\GeminiRepository\GeminiRepository;
use Illuminate\Http\JsonResponse;

class GeminiService
{
  protected $repo;

  /**
   * Constructor for [GeminiRepository] class.
   */
  public function __construct(GeminiRepository $repo)
  {
    $this->repo = $repo;
  }

  /**
   * Accesses the method [fetchData] inside GeminiRepository.
   */
  public function fetchData(string $question) : string
  {
    return $this->repo->fetchData($question);
  }
}
