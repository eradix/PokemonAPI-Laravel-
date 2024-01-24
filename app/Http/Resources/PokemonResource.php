<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PokemonResource extends JsonResource
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
                'bio' => (string)$this->bio,
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
                ],

            'relationships' => [
                'types' => $this->types->count() !== 0 ? 
                    $this->types->map(function($type){
                        return [
                            'type_id' => $type->id,
                            'type_name' => $type->name
                        ];
                    }) : null,

                'abilities' => $this->abilities->count() !== 0 ? 
                        $this->abilities->map(function ($ability){
                                    return [
                                        'ability_id' => $ability->id,
                                        'ability_name' => $ability->name
                                    ];
                 }) : null
            ]

        ];
    }
}
