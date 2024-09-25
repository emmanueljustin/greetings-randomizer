<?php

namespace App\Services;

use App\Models\RandomGreetings;
use App\Repositories\RandomGreetingsRepository\RandomGreetingsRepository;
use Illuminate\Support\Collection;

class RandomGreetingsService
{
  protected $repo;

  /**
   * Constructor for [RandomGreetingsService] class.
   */
  public function __construct(RandomGreetingsRepository $repo)
  {
    $this->repo = $repo;
  }

  /**
   * Accesses the method [getRandomGreetings] inside RandomGreetingsRepository.
   */
  public function getRandomGreetings() : Collection
  {
    return $this->repo->getRandomGreetings();
  }

  /**
   * Accesses the method [addNewGreetings] inside RandomGreetingsRepository.
   */
  public function addNewGreetings(array $payload) : RandomGreetings
  {
    return $this->repo->addNewGreetings($payload);
  }
}
