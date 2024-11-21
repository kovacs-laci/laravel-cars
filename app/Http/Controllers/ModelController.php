<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\Model;
use App\Models\Trim;
use App\Traits\ValidationRules;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    use ValidationRules;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $sortBy = request()->query('sort_by', 'name');
//        $sortDir = request()->query('sort_dir', 'asc');
        $models = []; //Model::all(); //orderBy($sortBy, $sortDir)->paginate(config('app.pagination'));
        $makers = Maker::all();
        $selectedMakerId = 0;
        return view('model.index', compact('models', 'makers', 'selectedMakerId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = Maker::all();
        return view('model.create', compact('makers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());
        Model::create($request->all());

        return redirect()->route('models.index')->with('success', "{$request->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Model::find($id);
        return view('model.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Model::find($id);
        $makers = Maker::all();
        return view('model.edit', compact('model', 'makers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->getValidationRules());
        $model  = Model::find($id);
        $model->name = $request->input('name');
        $model->maker_id = $request->input('maker_id');
        $model->save();

        return redirect()->route('models.index')->with('success', "{$model->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model  = Model::find($id);
        $model->delete();

        return redirect()->route('models.index')->with('success', "Sikeresen törölve");
    }

    public function filter(Request $request)
    {
        $selectedMakerId = $request->input('maker_id');
        $maker = Maker::find($selectedMakerId);
        $logoPath = '';
        if ($maker->logo) {
            $logoPath = env('APP_LOGO_PATH') . $maker->logo;
        }
        $makers = Maker::all();
        $models = $maker->models;
        return view('model.index', compact('models', 'makers', 'selectedMakerId', 'logoPath'));
    }

    private function getValidationRules()
    {
        return [
            $this->getNameValidationRules(),
            ['maker_id' => 'required|exists:makers,id',]
        ];

    }

    public function fetchTrims($modelId)
    {
        $result['data'] = Trim::orderby("name")
            ->select('id','name')
            ->where('model_id', $modelId)
            ->get();

        return response()->json($result);
    }
}
