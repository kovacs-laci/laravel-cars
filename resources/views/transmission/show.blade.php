@extends('layout')

@section('content')
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
    <h1>{{ $entity->name }}</h1>
    <ul>
        @include('basic-table-short-header')
        <li class="row">
            <div class="col">{{ $entity->id }}</div>
            <div class="col">{{$entity->name}}</div>
        </li>
    </ul>
    <a href="{{ route('transmissions.index') }}">Vissza</a>
@endsection
