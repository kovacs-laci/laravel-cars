@extends('layout')

@section('content')
    <div>
        <!-- He who is contented is rich. - Laozi -->
    </div>
    <h1>Járművek</h1>
    <div class="container">
        @include('success')

        @if(! empty($logoPath))
            <img id="logo" src="{{$logoPath}}" alt="logo">
        @else
            <img src="" alt="">
        @endif

        <br>
        <a href="{{ route('vehicles.create') }}" title="Új">Új hozzáadása</a>
        <div class="row header">
            <div class="col">#</div>
            <div class="col">Rendszám</div>
            <div class="col">Alvázszám</div>
            <div class="col">Motorszám</div>
            <div class="col">Gyártási év</div>
            <div class="col">Gyártó</div>
            <div class="col">Model</div>
            <div class="col">Típus</div>
            <div class="col">Üzemanyag</div>
            <div class="col">Műszaki érv.</div>
            <div class="col">Megjegyzés</div>
            <div class="col">Műveletek</div>
        </div>
        @foreach($vehicles as $vehicle)
            <div class="row {{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                <div class="col id">{{ $vehicle->id }}</div>
                <div class="col">{{ $vehicle->registration_plate }}</div>
                <div class="col">{{ $vehicle->vin }}</div>
                <div class="col">{{ $vehicle->engine_id }}</div>
                <div class="col">{{ $vehicle->production_year }}</div>
                <div class="col">{{ $vehicle->maker ? $vehicle->maker->name : "" }}</div>
                <div class="col">{{ $vehicle->model ? $vehicle->model->name : "" }}</div>
                <div class="col">{{ $vehicle->trim ? $vehicle->trim->name : "" }}</div>
                <div class="col">{{ $vehicle->fuel ? $vehicle->fuel->name : "" }}</div>
                <div class="col">{{ $vehicle->valid_until }}</div>
                <div class="col">{{ $vehicle->note }}</div>
                <div class="right">
                    <div class="col">
                        <a href="{{ route('vehicles.show', $vehicle->id) }}"><button><i class="fa fa-binoculars" title="Mutat"></i></button></a>
                    </div>
                    @if(auth()->check())
                        <div class="col">
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}"><button><i class="fa fa-edit edit" title="Módosít"></i></button></a>
                        </div>
                        <div class="col">
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="btn-del-model"><i class="fa fa-trash-can trash" title="Töröl"></i></button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

