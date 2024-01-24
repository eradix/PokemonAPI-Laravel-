<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Resources\TypeResource;
use App\Traits\HttpResponses;

class TypeController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TypeResource::collection(Type::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        # validate type request
        $request->validated($request->all());

        # create pokemon type
        $type = Type::create([
            'name' => $request->name,
        ]);

        return new TypeResource($type);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return new TypeResource($type);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        # update the type based on request data
        $type->update($request->all());

        return new TypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        # delete the type
        $type->delete();

        return response(null, 204);
    }
}
