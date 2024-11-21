@extends('layout')

@section('content')
    <div>
        <!-- The only way to do great work is to love what you do. - Steve Jobs -->
    </div>
    <h1>Típusok</h1>
    <div class="container">
        @include('success')
        <form method="post" action="{{ route('trims.filter') }}">
            @csrf
            <select id="select-maker" name="maker_id" title="Gyártók">
                <option value="0">-- Válassz gyártót --</option>
                @foreach($makers as $maker)
                    <option value="{{ $maker->id }}" {{($maker->id == $selectedMakerId ? 'selected' : '')}}>{{ $maker->name }}</option>
                @endforeach
            </select>

            <select id="select-model" name="model_id" title="Modellek">
                <option value="0">-- Válassz modelt --</option>
                @foreach($models as $model)
                    <option value="{{ $model->id }}" {{($model->id == $selectedModelId ? 'selected' : '')}}>{{ $model->name }}</option>
                @endforeach
            </select>
            <button type="submit">OK</button>
        </form>

        @if(! empty($logoPath))
            <img id="logo" src="{{$logoPath}}" alt="logo">
        @else
            <img src="" alt="">
        @endif

        <br>
        <a href="{{ route('trims.create') }}" title="Új">Új hozzáadása</a>

        <ul>
            @foreach($trims as $trim)
                <li class="row {{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                    <div class="col id">{{ $trim->id }}</div>
                    <div class="col">{{ $trim->name }}</div>
                    <div class="right">
                        <div class="col">
                            <a href="{{ route('trims.show', $trim->id) }}"><button><i class="fa fa-binoculars" title="Mutat"></i></button></a>
                        </div>
                        @if(auth()->check())
                            <div class="col">
                                <a href="{{ route('trims.edit', $trim->id) }}"><button><i class="fa fa-edit edit" title="Módosít"></i></button></a>
                            </div>
                            <div class="col">
                                <form action="{{ route('trims.destroy', $model->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="btn-del-model"><i class="fa fa-trash-can trash" title="Töröl"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
