@extends('layout')

@section('content')
<h1>Új típus</h1>
<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    @include('error')
    <form action="{{route('trims.store')}}" method="post">
        @csrf
        <fieldset>
            <label for="maker_id">Gyártó</label>
            <select name="maker_id" id="select-maker">
                <option value="0">-- Válassz gyártót --</option>
                @foreach($makers as $maker)
                    <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                @endforeach
            </select>
        </fieldset>
        <fieldset>
            <label for="model_id">Modell</label>
            <select name="model_id" id="select-model">
                <option value="0">-- Válassz modelt --</option>
                @foreach($models as $model)
                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset>
            <label for="name">Megnevezés</label>
            <input type="text" id="name" name="name">
        </fieldset>
        <button type="submit">Ment</button>
        <a href="{{ route('trims.index') }}">Mégse</a>
    </form>
</div>
@endsection
