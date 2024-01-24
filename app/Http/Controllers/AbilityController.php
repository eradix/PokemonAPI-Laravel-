<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbilityRequest;
use App\Http\Resources\AbilityResource;
use App\Models\Ability;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AbilityResource::collection(Ability::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbilityRequest $request)
    {
        # validate the ability request data
        $request->validated($request->all());

        # create pokemon ability
        $ability = Ability::create([
            'name' => $request->name
        ]);

        return new AbilityResource($ability);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ability $ability)
    {
        return new AbilityResource($ability);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ability $ability)
    {
        # update the ability based on request data
        $ability->update($request->all());

        return new AbilityResource($ability);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ability $ability)
    {
        # delete the ability
        $ability->delete();

        return response(null, 204);
    }
}
