@extends('layout')

@section('content')
<h1>Karosszériák</h1>
<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    @include('success')
    @include('search', ['route' => 'bodies.search'])
    <ul>
        @include('basic-table-header', ['route' => 'bodies.create'])
        @foreach($entities as $entity)
            <li class="row {{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                <div class="col id">{{ $entity->id }}</div>
                <div class="col">{{$entity->name}}</div>
                <div class="right">
                    <div class="col"><a href="{{ route('bodies.show', $entity->id) }}"><button><i class="fa fa-binoculars" title="Mutat"></i></button></a></div>
                    @if(auth()->check())
                        <div class="col"><a href="{{ route('bodies.edit', $entity->id) }}"><button><i class="fa fa-edit edit" title="Módosít"></i></button></a></div>
                        <div class="col">
                            <form action="{{ route('bodies.destroy', $entity->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="btn-del-fuel"><i class="fa fa-trash-can trash" title="Töröl"></i></button>
                            </form>
                        </div>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
