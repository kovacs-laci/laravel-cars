@extends('layout')

@section('content')
<h1>Új gyártó</h1>
<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    @include('error')

    <form action="{{ route('makers.store') }}" method="post">
        @csrf
        <fieldset>
            <label for="name">Megnevezés</label>
            <input type="text" id="name" name="name">
        </fieldset>
        <button type="submit">Ment</button>
        <a href="{{ route('makers.index') }}">Mégse</a>
    </form>
</div>
@endsection
