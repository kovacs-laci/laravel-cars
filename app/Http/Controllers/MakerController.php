<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicRequest;
use App\Models\Maker;
use App\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abc = $this->getAbc();
        $sortBy = request()->query('sort_by', 'name');
        $sortDir = request()->query('sort_dir', 'asc');
        $makers = Maker::orderBy($sortBy, $sortDir)->paginate(config('app.pagination'));
        return view('maker.index', compact('makers', 'abc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BasicRequest $request)
    {
        $entity  = new Maker();
        $entity->create($request->all());

        return redirect()->route('makers.index')->with('success', "$request->name sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maker = Maker::findOrFail($id);
        $models = $maker->models();

        return view('maker.show', compact('maker', 'models'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $maker = Maker::findOrFail($id);

        return view('maker.edit', compact('maker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BasicRequest $request, string $id)
    {
        $entity  = Maker::findOrFail($id);
        $entity->update($request->all());

        return redirect()->route('makers.index')->with('success', "$request->name sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entity  = Maker::find($id);
        if ($entity) {
            $entity->delete();
        }

        return redirect()->route('makers.index')->with('success', "Sikeresen törölve");
    }

    public function showModels(string $id)
    {
        $sortBy = request()->query('sort_by', 'name');
        $sortDir = request()->query('sort_dir', 'asc');
        $maker = Maker::findOrFail($id);
        $models = $maker->models->orderBy($sortBy, $sortDir)->paginate(config('app.pagination'));

        return view('maker.models', compact('maker', 'models'));
    }

    public static function getLogo($entity)
    {
        if (empty($entity->logo)) {
            return '';
        }

        return env('LOGO_PATH') . $entity->logo;
    }

    private function getAbc()
    {
        $abc = Maker::select(DB::raw("SUBSTR(name, 1, 1) as abc"))->distinct()->get();

        return $abc;
    }

    public function filter($ch)
    {
        $abc = $this->getAbc();
        $makers = Maker::where('name','LIKE',"$ch%")->paginate(config('app.pagination'));

        return view('maker.index', compact('makers', 'abc'));
    }

    public function search(Request $request) {
        $abc = $this->getAbc();
        $needle = $request->get('needle');
        $makers = Maker::orderBy('name')->where('name','LIKE',"%$needle%")->paginate(config('app.pagination'));

        return view('maker.index', compact('makers', 'abc'));
    }

    public function fetchModels($entityId)
    {
        $entity = Maker::find($entityId);
        $result['data'] = $entity->models;
        $result['logo'] = $this->getLogo($entity);

        return response()->json($result);
    }
}
