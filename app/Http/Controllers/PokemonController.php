<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePokemonRequest;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use App\Http\Resources\PokemonResource;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PokemonResource::collection(Pokemon::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePokemonRequest $request)
    {
        # validate pokemon request
        $request->validated($request->all());

        # create pokemon
        $pokemon = Pokemon::create([
            'name' => $request->name,
            'bio' => $request->bio
        ]);

        # attach pokemon types
        $pokemon->types()->attach($request->type_ids);

        # attact pokemon attributes
        $pokemon->abilities()->attach($request->ability_ids);

        return new PokemonResource($pokemon);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        return new PokemonResource($pokemon);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        # update the pokemon based on request data
        $pokemon->update($request->all());

        # check if has type ids
        if ($request->has('type_ids')) {
            $pokemon->types()->sync($request->type_ids);
        }

        # check if has ability ids
        if ($request->has('ability_ids')) {
            $pokemon->types()->sync($request->ability_ids);
        }

        return new PokemonResource($pokemon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        # detach/delete pokemon types in the pivot table
        $pokemon->types()->detach();

        # detach/delete pokemon abilities in the pivot table
        $pokemon->abilities()->detach();
        
        # delete the pokemon
        $pokemon->delete();

        return response(null, 204);
    }
}
