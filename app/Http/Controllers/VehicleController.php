<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\Body;
use App\Models\Color;
use App\Models\Fuel;
use App\Models\Maker;
use App\Models\Transmission;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
//    use ValidationRules;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('registration_plate')->get();

        return view('vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicle.create', [
            'fuels' => Fuel::all(),
            'makers' => Maker::all(),
            'models' => [],
            'trims' => [],
            'bodies' => Body::all(),
            'transmissions' => Transmission::all(),
            'colors' => Color::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        $entity = new Vehicle();
//        $entity = $this->setEntityData($entity, $request);
//        $entity->save();
        $entity->create($request->all());

        return redirect(route('vehicles.index') . '#' . $entity->id);
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
        $vehicle = Vehicle::findOrFail($id);
        if (!$vehicle) {
            return view('404');
        }
        // Access the related models as properties, not methods
        $maker = $vehicle->maker;  // Access the Maker model instance
        $model = $vehicle->model;  // Access the Model instance
        return view('vehicle/edit', [
            'vehicle' => $vehicle,
            'fuels' => Fuel::all(),
            'makers' => Maker::all(),
            'models' => $maker ? $maker->models : collect(),  // Check if maker exists
            'trims' => $model ? $model->trims : collect(),    // Check if model exists
            'logo' => $maker ? MakerController::getLogo($maker) : null,  // Check if maker exists
            'bodies' => Body::all(),
            'transmissions' => Transmission::all(),
            'colors' => Color::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, string $id)
    {
        /** @var Vehicle $vehicle */
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')->with('success', "{$vehicle->registration_plate} sikeresen módosítva");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::find($id);
        if (!$vehicle) {
            return view('404');
        }
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', "Sikeresen törölve");
    }

    private function setEntityData(Vehicle $entity, Request $request): ?Vehicle
    {
        $entity->maker_id = $request->get('maker_id');
        $entity->model_id = $request->get('model_id');
        $entity->trim_id = $request->get('trim_id');
        $entity->fuel_id = $request->get('fuel_id');
        $entity->body_id = $request->get('body_id');
        $entity->transmission_id = $request->get('transmission_id');
        $entity->color_id = $request->get('color_id');

        $entity->registration_plate = strtoupper($request->get('registration_plate'));
        $entity->vin = strtoupper($request->get('vin'));
        $entity->engine_id = strtoupper($request->get('engine_id'));
        $entity->production_year = $request->get('production_year');
        $entity->capacity = $request->get('capacity');
        $entity->power = $request->get('power');
        $entity->valid_until = $request->get('valid_until');
        $entity->notes = $request->get('notes');

        return $entity;
    }
}
