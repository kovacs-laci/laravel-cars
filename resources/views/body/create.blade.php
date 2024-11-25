@extends('layout')

@section('content')
<h1>Új karosszéria</h1>
<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    @include('error')

    <form action="{{ route('bodies.store') }}" method="post">
        @csrf
        <fieldset>
            <label for="name">Megnevezés</label>
            <input type="text" id="name" name="name">
        </fieldset>
        <button type="submit">Ment</button>
        <a href="{{ route('bodies.index') }}">Mégse</a>
    </form>
</div>
@endsection
