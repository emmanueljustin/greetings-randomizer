<?php

namespace App\Repositories\GeminiRepository;
use Illuminate\Http\JsonResponse;



interface IGeminiRepository
{
  public function fetchData(string $question) : string;
}
