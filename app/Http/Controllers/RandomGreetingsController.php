<?php

namespace App\Http\Controllers;

use App\Services\RandomGreetingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RandomGreetingsController extends Controller
{
    protected $randomGreetService;

    /**
     * Initializes the [RandomGreetingService] inside this class to be used in methods.
     */
    public function __construct(RandomGreetingsService $randomGreetService)
    {
        $this->randomGreetService = $randomGreetService;
    }

    /**
     * Returns an api response that contains the random greetings.
     */
    public function getRandomGreetings() : JsonResponse
    {
        $data = $this->randomGreetService->getRandomGreetings();

        if ($data->isEmpty()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'There are no greetings available.'
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'message' => 'Here is your requested greetings.',
            'data' => $data
        ]);
    }

    /**
     * Saves a greeting that can be used later when fetching random greetings.
     */
    public function addNewGreetings(Request $request) : JsonResponse
    {
        $field = $request->validate([
            'greetings' => 'required|string'
        ]);

        $result = $this->randomGreetService->addNewGreetings($field);

        return response()->json([
            'status' => 'ok',
            'message' => 'Succesfully saved the greetings thank you.',
            'savedGreetings' => $result
        ]);
    }
}
