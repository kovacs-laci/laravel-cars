@extends('layout')
<div>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
</div>
@section('content')
    <div>
        <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
        @include('error')
        <form action="{{ route('makers.update', $maker->id) }}" method="post">
            @csrf
            @method('PATCH')
            <fieldset style="display: flex; flex-direction: column; gap: 10px;">
                <label for="name">Megnevezés</label>
                <input type="text" id="name" name="name" required value="{{ old('name', $maker->name) }}">
                <label for="logo">Logo</label>
                <input type="file" id="logo" name="logo">
                <small>Upload your logo file here</small>
                <img id="logo-preview" src="{{env('APP_LOGO_PATH') . $maker->logo}}" alt="{{$maker->logo}}" title="{{$maker->name}}">
            </fieldset>
            <button type="submit">Ment</button>
        </form>
        <a href="{{ route('makers.index') }}">Mégse</a>
    </div>
@endsection
