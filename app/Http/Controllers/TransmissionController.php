<?php

namespace App\Http\Controllers;

use App\Models\Transmission;
use App\Traits\ValidationRules;
use Illuminate\Http\Request;

class TransmissionController extends Controller
{
    use ValidationRules;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transmissions = Transmission::all();
        return view('transmission.index', compact('transmissions'));
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
    public function store(Request $request)
    {
        $request->validate($this->getNameValidationRules());
        $transmission  = new Transmission();
        $transmission->name = $request->input('name');
        $transmission->save();

        return redirect()->route('transmissions.index')->with('success', "{$transmission->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transmission = Transmission::find($id);
        return view('transmission.show', compact('transmission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transmission = Transmission::find($id);
        return view('transmission.edit', compact('transmission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->getNameValidationRules());
        $transmission  = Transmission::find($id);
        $transmission->name = $request->input('name');
        $transmission->save();

        return redirect()->route('transmissions.index')->with('success', "{$transmission->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transmission  = Transmission::find($id);
        $transmission->delete();

        return redirect()->route('transmissions.index')->with('success', "Sikeresen törölve");
    }
}
