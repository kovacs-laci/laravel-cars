<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\Model;
use App\Models\Trim;
use App\Traits\ValidationRules;
use Illuminate\Http\Request;

class TrimController extends Controller
{

    use ValidationRules;

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
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());
        Trim::create($request->all());

        return $this->filter($request)->with('success', "{$request->name} sikeresen létrehozva");

//        return redirect()->route('trims.index')->with('success', "{$request->name} sikeresen létrehozva");
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
        $trim = Trim::find($id);
        $model = $trim->model;
        $maker = $model->maker;
        $models = $maker->models;
        $makers = Maker::all();
        return view('model.edit', compact('trim', 'model', 'maker', 'models', 'makers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    private function getValidationRules()
    {
        return [
            $this->getNameValidationRules(),
            ['maker_id' => 'required|exists:makers,id',]
        ];

    }
}
