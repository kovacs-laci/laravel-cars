@extends('layout')
@section('content')
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    <h1>{{ $entity->name }} módosítása</h1>
    <div>
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
        @include('error')
        <form action="{{ route('transmissions.update', $entity->id) }}" method="post">
            @csrf
            @method('PATCH')
            <fieldset>
                <label for="name">Megnevezés</label>
                <input type="text" id="name" name="name" required value="{{ old('name', $entity->name) }}">
            </fieldset>
            <button type="submit">Ment</button>
            <a href="{{ route('transmissions.index') }}">Mégse</a>
        </form>
    </div>
@endsection
