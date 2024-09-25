<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeminiController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    // protected $geminiClient;
    
    // public function __construct()
    // {
    //     $api_key = config('gemini.api_key');
    //     $this->geminiClient = new Client($api_key);
    // }

    public function fetchData(Request $request) : JsonResponse
    {
        $validatedReq = $request->validate([
            'questions' => 'required|string'
        ]);

        $answer = $this->geminiService->fetchData($validatedReq['questions']);

        // $response = $this->geminiClient->geminiPro()->generateContent(new TextPart($validatedReq['questions']));

        // $filteredResponse = $response->candidates[0]->content->parts[0]->text;
        return response()->json([
            'result' => $answer
        ]);
    }
}
