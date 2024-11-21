@extends('layout')

@section('content')
<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
</div>

<h1>Új jármű</h1>
<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    @include('error')
    <form action="{{route('vehicles.store')}}" method="post">
        @csrf
        <fieldset>
            <label for="registration_plate" class="bold">Rendszám</label>
            <input class="uppercase" type="text" name="registration_plate" id="registration_plate" width="150px">
        </fieldset>
        <fieldset>
            <label for="vin" class="bold">Alvázszám</label>
            <input class="uppercase" type="text" name="vin" id="vin" width="150px">
        </fieldset>
        <fieldset>
            <label for="maker_id">Gyártó</label>
            <select name="maker_id" id="select-maker" title="Gyártók">
                <option value="0">-- Válassz gyártót --</option>
                @foreach($makers as $maker)
                    <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <label for="model_id">Model</label>
            <select name="model_id" id="select-model"  title="Modellek">
                <option value="0">-- Válassz modelt --</option>
                @foreach($models as $model)
                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <label for="trim_id">Típus</label>
            <select name="trim_id" id="select-trim" title="Típusok">
                <option value="0">-- Válassz típust --</option>
                @foreach($trims as $trim)
                    <option value="{{ $trim->id }}">{{ $trim->name }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <label for="color_id">Szín</label>
            <select name="color_id" id="select-color"  title="Színek">
                <option value="0">-- Válassz színt --</option>
                @foreach ($colors as $color)
                    <option value="{{$color->id}}" style="background-color: {{$color->hexa_code}}">{{$color->name}}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <label for="fuel_id">Üzemanyag</label>
            <select name="fuel_id" id="select-fuel"  title="Üzemanyagok">
                <option value="0">-- Válassz üzemanyagot --</option>
                @foreach ($fuels as $fuel)
                    <option value="{{$fuel->id}}">{{$fuel->name}}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <label for="body_id">Karosszéria</label>
            <select name="body_id" id="select-body"  title="Karosszériák">
                <option value="0">-- Válassz karosszériát --</option>
                @foreach ($bodies as $body)
                    <option value="{{$body->id}}">{{$body->name}}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <label for="transmission_id">Sebváltó</label>
            <select name="transmission_id" id="select-transmission"  title="Sebváltók">
                <option value="0">-- Válassz sebváltót --</option>
                @foreach ($transmissions as $transmission)
                    <option value="{{$transmission->id}}">{{$transmission->name}}</option>
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
