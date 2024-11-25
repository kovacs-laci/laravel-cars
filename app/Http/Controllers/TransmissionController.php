<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicRequest;
use App\Models\Transmission;

class TransmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entities = Transmission::all();
        return view('transmission.index', compact('entities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transmission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BasicRequest $request)
    {
        $entity  = new Transmission();
        $entity->create($request->all());

        return redirect()->route('transmissions.index')->with('success', "{$entity->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entity = Transmission::findOrFail($id);

        return view('transmission.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entity = Transmission::findOrFail($id);

        return view('transmission.edit', compact('entity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BasicRequest $request, string $id)
    {
        $entity = Transmission::findOrFail($id);
        $entity->update($request->all());

        return redirect()->route('transmissions.index')->with('success', "{$entity->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entity = Transmission::find($id);
        if ($entity) {
            $entity->delete();
        }

        return redirect()->route('transmissions.index')->with('success', "Sikeresen törölve");
    }
}
