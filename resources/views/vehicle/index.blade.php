@extends('layout')

@section('content')
    <!-- He who is contented is rich. - Laozi -->
    <h1>Járművek</h1>
    <div class="container">

        @if(! empty($logoPath))
            <img id="logo" src="{{$logoPath}}" alt="logo">
        @else
            <img src="" alt="">
        @endif
        @include('success')
        @include('search', ['route' => 'vehicles.search'])
        <table>
            <thead class="table-head">
                <tr>
                    <td class="col" id="col-head-id">#</td>
                    <td class="col" id="col-head-registration-plate">Rendszám</td>
                    <td class="col" id="col-head-vin">Alvázszám</td>
                    <td class="col" id="col-head-engine-id">Motorszám</td>
                    <td class="col" id="col-head-production-year">Gyártási év</td>
                    <td class="col" id="col-head-maker">Gyártó</td>
                    <td class="col" id="col-head-model">Model</td>
                    <td class="col" id="col-head-trim">Típus</td>
                    <td class="col" id="col-head-fuel">Üzemanyag</td>
                    <td class="col" id="col-head-valid-until">Műszaki érv.</td>
                    <td class="col" id="col-head-notes">Megjegyzés</td>
                    <td class="col" id="col-head-actions" style="display:flex">Műveletek
                        @if(auth()->check())
                            <div>
                                <a class="plus" href="{{ route('vehicles.create') }}" title="Új">&nbsp;<i class="fa fa-plus"></i></a>
                            </div>
                        @endif
                    </td>
                </tr>
            </thead>
            <tbody>
            @foreach($vehicles as $vehicle)
                <tr class="{{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                    <td class="col id">{{ $vehicle->id }}</td>
                    <td class="col">{{ $vehicle->registration_plate }}</td>
                    <td class="col">{{ $vehicle->vin }}</td>
                    <td class="col">{{ $vehicle->engine_id }}</td>
                    <td class="col">{{ $vehicle->production_year }}</td>
                    <td class="col">{{ $vehicle->maker ? $vehicle->maker->name : "" }}</td>
                    <td class="col">{{ $vehicle->model ? $vehicle->model->name : "" }}</td>
                    <td class="col">{{ $vehicle->trim ? $vehicle->trim->name : "" }}</td>
                    <td class="col">{{ $vehicle->fuel ? $vehicle->fuel->name : "" }}</td>
                    <td class="col">{{ $vehicle->valid_until }}</td>
                    <td class="col">{{ $vehicle->note }}</td>
                    <td  class="col right">
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

