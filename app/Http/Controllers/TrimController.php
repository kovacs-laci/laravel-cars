<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrimRequest;
use App\Models\Maker;
use App\Models\Model;
use App\Models\Trim;
use Illuminate\Http\Request;

class TrimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('trim.index', [
            'makers' => Maker::all(),
            'models' => [],
            'trims' => [],
            'selectedMakerId' => 0,
            'selectedModelId' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('trim.create', [
            'makers' => Maker::all(),
            'models' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrimRequest $request)
    {
        Trim::create($request->all());

        return $this->filter($request)->with('success', "{$request->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $trim = Trim::findOrFail($id);
        $model = $trim->model;
        $maker = $model->maker;
        $models = $maker->models;
        $makers = Maker::all();
        return view('model.edit', compact('trim', 'model', 'maker', 'models', 'makers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrimRequest $request, string $id)
    {
        $trim = Trim::findOrFail($id);
        $trim->update($request->all());

        return $this->filter($request)->with('success', "{$request->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $entity = Trim::find($id);
        if ($entity) {
            $entity->delete();
        }

        return $this->filter($request)->with('success', "Sikeresen törölve");
    }

    public function filter(Request $request)
    {
        $selectedMakerId = $request->input('maker_id');
        $selectedModelId = $request->input('model_id');
        $maker = Maker::find($selectedMakerId);
        $logoPath = '';
        if ($maker->logo) {
            $logoPath = env('APP_LOGO_PATH') . $maker->logo;
        }

        $makers = Maker::all();
        $models = $maker->models;

        $model = Model::find($selectedModelId);
        $trims = $model->trims;

        return view('trim.index', compact('trims', 'models', 'makers', 'selectedMakerId', 'selectedModelId', 'logoPath'));
    }

    public function search(Request $request)
    {
        $needle = $request->get('needle');
        $entities = Trim::select('*')
            ->where('name', 'like', "%{$needle}%")
            ->orderBy('name')
            ->get();
        if (empty($entities)) {
            return view('404');
        }

        return view('trim.index', compact('entities'));
    }
}
