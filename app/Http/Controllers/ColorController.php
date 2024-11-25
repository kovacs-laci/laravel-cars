<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicRequest;
use App\Models\Body;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entities = Color::all();
        return view('color.index', compact('entities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('color.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BasicRequest $request)
    {
        $entity  = new Color();
        $entity->create($request->all());

        return redirect()->route('bodies.index')->with('success', "{$entity->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entity = Color::findOrFail($id);

        return view('color.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entity = Color::findOrFail($id);

        return view('color.edit', compact('entity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BasicRequest $request, string $id)
    {
        $entity = Color::findOrFail($id);
        $entity->update($request->all());

        return redirect()->route('colors.index')->with('success', "{$entity->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entity = Color::find($id);
        if ($entity) {
            $entity->delete();
        }

        return redirect()->route('bodies.index')->with('success', "Sikeresen törölve");
    }

    public function search(Request $request)
    {
        $needle = $request->get('needle');
        $entities = Color::select('*')
            ->where('name', 'like', "%{$needle}%")
            ->orderBy('name')
            ->get();
        if (empty($entities)) {
            return view('404');
        }

        return view('color.index', compact('entities'));
    }
}
