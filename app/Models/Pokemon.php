<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Ability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio'
    ];

    # many to many relationship with types
    public function types()
    {
        return $this->belongsToMany(Type::class, 'pokemon_types');
    }

    # many to many relationship with abilities
    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'pokemon_abilities');
    }
}
