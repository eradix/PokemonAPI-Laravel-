<?php

namespace App\Models;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    # many to many relationship with pokemon
    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class, 'pokemon_abilities');
    }
}
