<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Traits\ValidationRules;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    use ValidationRules;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuels = Fuel::all();
        return view('fuel.index', compact('fuels'));
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
    public function store(Request $request)
    {
        $request->validate($this->getNameValidationRules());
        $fuel  = new Fuel();
        $fuel->name = $request->input('name');
        $fuel->save();

        return redirect()->route('fuels.index')->with('success', "{$fuel->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fuel = Fuel::find($id);
        return view('fuel.show', compact('fuel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fuel = Fuel::find($id);
        return view('fuel.edit', compact('fuel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->getNameValidationRules());
        $fuel  = Fuel::find($id);
        $fuel->name = $request->input('name');
        $fuel->save();

        return redirect()->route('fuels.index')->with('success', "{$fuel->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fuel  = Fuel::find($id);
        $fuel->delete();

        return redirect()->route('fuels.index')->with('success', "Sikeresen törölve");
    }
}
