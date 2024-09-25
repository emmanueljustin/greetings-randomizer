<?php

namespace App\Repositories\RandomGreetingsRepository;

use App\Models\RandomGreetings;
use Illuminate\Database\Eloquent\Collection;

interface IRandomGreetingsRepository
{
  public function getRandomGreetings() : Collection;
  public function addNewGreetings(array $payload) : RandomGreetings;
}
