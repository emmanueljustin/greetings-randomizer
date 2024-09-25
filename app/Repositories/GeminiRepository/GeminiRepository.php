<?php

namespace App\Repositories\GeminiRepository;

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Http\JsonResponse;

class GeminiRepository implements IGeminiRepository
{
  protected $geminiClient;

  /**
   * Responsible for injecting api key in Client
   */
  public function __construct()
  {
    $api_key = config('gemini.api_key');
    $this->geminiClient = new Client($api_key);
  }
  
  /**
   * Handles the questions and sends it to gemini and then fetches the result that is thrown back by gemini
   */
  public function fetchData(string $question) : string
  {
    $response = $this->geminiClient->geminiPro()->generateContent(new TextPart($question));

    // $filteredResponse = $response->candidates[0]->content->parts[0]->text;

    if (isset($response->candidates[0]->content->parts[0]->text)) {
      $filteredResponse = $response->candidates[0]->content->parts[0]->text;
    } else {
        return 'No content found';
    }

    return $filteredResponse;
  }
}
