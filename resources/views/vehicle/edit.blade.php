@extends('layout')

@section('content')
    <div>
        <!-- Order your soul. Reduce your wants. - Augustine -->
    </div>

    <h1>Jármű módosítása</h1>
    <div>
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
        @include('error')
        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="post">
            @csrf
            @method('PATCH')
            <fieldset>
                <label for="registration_plate" class="bold">Rendszám</label>
                <input class="uppercase" type="text" name="registration_plate" id="registration_plate" value="{{ $vehicle->registration_plate }}" width="150px" >
            </fieldset>
            <fieldset>
                <label for="vin" class="bold">Alvázszám</label>
                <input class="uppercase" type="text" name="vin" id="vin" value="{{ $vehicle->vin }}"width="150px" >
            </fieldset>
            <fieldset>
                <label for="maker_id">Gyártó</label>
                <select name="maker_id" id="select-maker" title="Gyártók">
                    <option value="0">-- Válassz gyártót --</option>
                    @foreach($makers as $maker)
                        <option value="{{ $maker->id }}" @if($maker->id == $vehicle->maker_id) selected  @endif>{{ $maker->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="model_id">Model</label>
                <select name="model_id" id="select-model"  title="Modellek">
                    <option value="0">-- Válassz modelt --</option>
                    @foreach($models as $model)
                        <option value="{{ $model->id }}" @if($model->id == $vehicle->model_id) selected @endif>{{ $model->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="trim_id">Típus</label>
                <select name="trim_id" id="select-trim" title="Típusok">
                    <option value="0">-- Válassz típust --</option>
                    @foreach($trims as $trim)
                        <option value="{{ $trim->id }}" @if($trim->id == $vehicle->trim_id) selected @endif>{{ $trim->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="color_id">Szín</label>
                <select name="color_id" id="select-color"  title="Színek">
                    <option value="0">-- Válassz színt --</option>
                    @foreach ($colors as $color)
                        <option value="{{$color->id}}" @if($color->id == $vehicle->color_id) selected @endif style="background-color: {{$color->hexa_code}}">{{$color->name}}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="fuel_id">Üzemanyag</label>
                <select name="fuel_id" id="select-fuel"  title="Üzemanyagok">
                    <option value="0">-- Válassz üzemanyagot --</option>
                    @foreach ($fuels as $fuel)
                        <option value="{{$fuel->id}}" @if($fuel->id == $vehicle->fuel_id) selected @endif>{{$fuel->name}}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="body_id">Karosszéria</label>
                <select name="body_id" id="select-body"  title="Karosszériák">
                    <option value="0">-- Válassz karosszériát --</option>
                    @foreach ($bodies as $body)
                        <option value="{{$body->id}}" @if($body->id == $vehicle->bogy_id) selected @endif>{{$body->name}}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="transmission_id">Sebváltó</label>
                <select name="transmission_id" id="select-transmission"  title="Sebváltók">
                    <option value="0">-- Válassz sebváltót --</option>
                    @foreach ($transmissions as $transmission)
                        <option value="{{$transmission->id}}" @if($transmission->id == $vehicle->transmission_id) selected @endif>{{$transmission->name}}</option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset>
                <label for="engine_id">Motorszám</label>
                <input type="text" name="engine_id" id="engine_id" width="150px">
            </fieldset>
            <fieldset>
                <label for="production_year">Gyártás éve</label>
                <input type="text" name="production_year" id="production_year" width="50px">
            </fieldset>
            <fieldset>
                <label for="capacity">Hengerűrtartalom [cm3]</label>
                <input type="text" name="capacity" id="capacity" width="50px">
            </fieldset>
            <fieldset>
                <label for="power">Teljesítmény [kW]</label>
                <input type="text" name="power" id="power" width="50px">
            </fieldset>
            <fieldset>
                <label for="valid_until">Forgalmi érvényes</label>
                <input type="date" name="valid_until" id="valid_until" width="100px">
            </fieldset>
            <fieldset>
                <label for="power">Megjegyzés</label>
                <textarea name="notes" id="notes"></textarea>
            </fieldset>
            <button type="submit">Ment</button>
        </form>
        <a href="{{ route('vehicles.index') }}">Mégse</a>
    </div>
@endsection
