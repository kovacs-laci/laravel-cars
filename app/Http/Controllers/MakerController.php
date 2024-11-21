<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use App\Models\Model;
use App\Traits\ValidationRules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakerController extends Controller
{
    use ValidationRules;

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
    public function store(Request $request)
    {
        $validationRules = $this->getNameValidationRules();
        $request->validate($validationRules[0], $validationRules[1]);
        $maker  = new Maker();
        $maker->name = $request->input('name');
        $maker->save();

        return redirect()->route('makers.index')->with('success', "{$maker->name} sikeresen létrehozva");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $maker = Maker::find($id);
        $models = $maker->models();

        return view('maker.show', compact('maker', 'models'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $maker = Maker::find($id);

        return view('maker.edit', compact('maker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->getNameValidationRules());
        $maker  = Maker::find($id);
        $maker->name = $request->input('name');
        $maker->save();

        return redirect()->route('makers.index')->with('success', "{$maker->name} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maker  = Maker::find($id);
        $maker->delete();

        return redirect()->route('makers.index')->with('success', "Sikeresen törölve");
    }

    public function showModels(string $id)
    {
//        $sortBy = request()->query('sort_by', 'name');
//        $sortDir = request()->query('sort_dir', 'asc');
        $maker = Maker::find($id);
        $models = $maker->models(); //->orderBy($sortBy, $sortDir)->paginate(config('app.pagination'));

        return view('maker.models', compact('maker', 'models'));
    }

    public static function getLogo($maker)
    {
//        $maker = Maker::find($id);
        if (empty($maker->logo)) {
            return '';
        }

        return env('LOGO_PATH') . $maker->logo;
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
//        if (!$makers) {
//            return view('404');
//        }

        return view('maker.index', compact('makers', 'abc'));
    }

    public function fetchModels($makerId)
    {
        $maker = Maker::find($makerId);
        $result['data'] = Model::orderby("name")
            ->select('id','name')
            ->where('maker_id', $makerId)
            ->get();;
        $result['logo'] = $this->getLogo($maker);

        return response()->json($result);
    }
}
