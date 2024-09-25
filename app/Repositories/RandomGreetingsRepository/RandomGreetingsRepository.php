<?php

namespace App\Repositories\RandomGreetingsRepository;

use App\Models\RandomGreetings;
use App\Repositories\RandomGreetingsRepository\IRandomGreetingsRepository;
use Illuminate\Database\Eloquent\Collection;

class RandomGreetingsRepository implements IRandomGreetingsRepository
{

  /**
   * Fetch random greetings from DB and returns it as a collection.
   */
  public function getRandomGreetings() : Collection
  {
    $randomGreet = RandomGreetings::inRandomOrder()->limit(1)->get();

    return $randomGreet;
  }

  /**
   * Saves a new greeting in the database.
   */
  public function addNewGreetings(array $payload) : RandomGreetings
  {
    return RandomGreetings::create($payload);
  }
}
