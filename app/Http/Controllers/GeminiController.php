<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeminiController extends Controller
{
    protected $geminiService;

    /**
     * Initializes the [GeminiService] inside this class to be used in methods.
     */
    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    /**
     * Returns an api response that contains Gemini's answer to the question.
     */
    public function fetchData(Request $request) : JsonResponse
    {
        $validatedReq = $request->validate([
            'questions' => 'required|string'
        ]);

        $answer = $this->geminiService->fetchData($validatedReq['questions']);
        
        return response()->json([
            'result' => $answer
        ]);
    }
}
