<div>
    <!-- Very little is needed to make a happy life. - Marcus Aurelius -->
</div>

@extends('layout')

@section('content')
    <h1>Model módosítása</h1>
    <div>
        @include('error')
        <form action="{{ route('models.store') }}" method="post">
            @csrf
            <fieldset>
                <label for="maker_id">Gyártó</label>
                <select name="maker_id" id="maker_id">

                    @foreach($makers as $maker)
                        {{ $selected = '' }}
                        @if($maker->id == $model->maker->id)
                            {{ $selected = 'selected' }}
                            {{ $logo = $maker->logo }}
                            {{ $name = $maker->name }}
                        @endif
                        <option value="{{ $maker->id }}" {{ $selected }}>{{ $maker->name }}</option>
                    @endforeach
                </select>
                <img src="{{env('APP_LOGO_PATH') . $logo}}" alt="{{$logo}}" title="{{$name}}">
            </fieldset>
            <fieldset>
                <label for="name">Megnevezés</label>
                <input type="text" id="name" name="name" value="{{ old('name', $model->name) }}">
            </fieldset>
            <button type="submit">Ment</button>
            <a href="{{ route('models.index') }}">Mégse</a>
        </form>
    </div>
@endsection
