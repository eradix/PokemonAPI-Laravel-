<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AbilityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,

            'attributes' => [
                'name' => (string)$this->name,
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
                ],

            'relationships' => [
                'pokemons' => $this->pokemons->count() !== 0 ? 
                    $this->pokemons->map(function($pokemon){
                        return [
                            'pokemon_id' => $pokemon->id,
                            'pokemon_name' => $pokemon->name,
                            'bio' => $pokemon->bio
                        ];
                    }) : null,
            ]
        ];
    }
}
