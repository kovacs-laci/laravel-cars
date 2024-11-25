<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicRequest;
use App\Models\Fuel;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entities = Fuel::all();
        return view('fuel.index', compact('entities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fuel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BasicRequest $request)
    {
        $entity = new Fuel();
        $entity->create($request->all());

        return redirect()->route('fuels.index')->with('success', "{$entity->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entity = Fuel::findOrFail($id);

        return view('fuel.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entity = Fuel::findOrFail($id);

        return view('fuel.edit', compact('entity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BasicRequest $request, string $id)
    {
        $entity  = Fuel::findOrFail($id);
        $entity->update($request->all());

        return redirect()->route('fuels.index')->with('success', "{$entity->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entity  = Fuel::find($id);
        if ($entity) {
            $entity->delete();
        }

        return redirect()->route('fuels.index')->with('success', "Sikeresen törölve");
    }
}
