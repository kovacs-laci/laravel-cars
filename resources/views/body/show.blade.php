@extends('layout')

<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>

@section('content')
    <h1>"{{ $body->name }}" karosszéria</h1>
    <div class="row">
        <div>{{ $body->id }}</div>
        <div>{{$body->name}}</div>
    </div>
@endsection
