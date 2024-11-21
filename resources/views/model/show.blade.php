<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div>

@extends('layout')

@section('content')
    <h1>Model: {{ $model->name }}</h1>
    <h2>Gyártó: {{ $model->maker->name }}</h2>
    <div class="row">
        <div>{{ $model->id }}</div>
        <div>{{ $model->name }}</div>
    </div>
@endsection

