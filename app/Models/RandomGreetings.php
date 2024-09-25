<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomGreetings extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'randomgreetings';

    protected $fillable = [
        'greetings'
    ];
}
