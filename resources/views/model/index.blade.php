@extends('layout')

@section('content')
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
    <h1>Modellek</h1>
    <div class="container">
        <form method="post" action="{{ route('models.filter') }}">
            @csrf
            <select id="maker-id" name="maker_id" title="Gyártók">
                <option value="0">-- Válassz gyártót --</option>
                @foreach($makers as $maker)
                    <option value="{{ $maker->id }}" {{($maker->id == $selectedMakerId ? 'selected' : '')}}>{{ $maker->name }}</option>
                @endforeach
            </select>
            <button type="submit">OK</button>
        </form>

        @if(! empty($logoPath))
            <img id="logo" src="{{$logoPath}}" alt="logo">
        @else
            <img src="" alt="">
        @endif
        @include('success')
        @include('search', ['route' => 'models.search'])
        <ul>
            @include('basic-table-header', ['route' => 'models.create'])
            @foreach($models as $model)
                <li class="row {{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                    <div class="col id">{{ $model->id }}</div>
                    <div class="col">{{ $model->name }}</div>
                    <div class="right">
                        <div class="col">
                            <a href="{{ route('models.show', $model->id) }}"><button><i class="fa fa-binoculars" title="Mutat"></i></button></a>
                        </div>
                        @if(auth()->check())
                            <div class="col">
                                <a href="{{ route('models.edit', $model->id) }}"><button><i class="fa fa-edit edit" title="Módosít"></i></button></a>
                            </div>
                            <div class="col">
                                <form action="{{ route('models.destroy', $model->id) }}" method="POST">
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

