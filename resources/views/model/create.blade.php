<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div>

@extends('layout')

@section('content')
    <h1>Új model</h1>
    <div>
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
        @include('error')
        <form action="{{ route('models.store') }}" method="post">
            @csrf
            <fieldset>
                <label for="maker_id">Gyártó</label>
                <select name="maker_id" id="maker_id">
                    @foreach($makers as $maker)
                        <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset>
                <label for="name">Megnevezés</label>
                <input type="text" id="name" name="name">
            </fieldset>
            <button type="submit">Ment</button>
        </form>
        <a href="{{ route('models.index') }}">Mégse</a>
    </div>
@endsection
