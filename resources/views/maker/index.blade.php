@extends('layout')

@section('content')
<h1>Gyártók</h1>
<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    @isset($abc)
    <nav>
        <ul>
            @foreach($abc as $ch)
                <li><a href="{{ route('makers.filter', $ch['abc']) }}"><button>{{ $ch['abc'] }}</button></a></li>
            @endforeach
        </ul>
    </nav>
    @endisset
    @include('success')
    @include('search', ['route' => 'makers.search'])
    <a href="{{ route('makers.index', ['sort_by' => 'name', 'sort_dir' => 'asc']) }}" title="ABC">&#11205;</a> / <a href="{{ route('makers.index', ['sort_by' => 'name', 'sort_dir' => 'desc']) }}" title="ZYX">&#11206;</a>
    <ul>
        @include('basic-table-header', ['route' => 'makers.create'])
        @foreach($makers as $maker)
            <li class="row {{ $loop->iteration % 2 == 0 ? 'even' : 'odd' }}">
                <div class="col id">{{ $maker->id }}</div>
                <div class="col">{{$maker->name}}</div>
                <div class="right">
                    <div class="col">
{{--                        <a href="{{ route('makers.show', $maker->id) }}"><button><i class="fa fa-binoculars" title="Mutat"></i></button></a></div>--}}
                        <form method="post" action="{{ route('models.filter') }}">
                            @csrf
                            <input type="hidden" name="maker_id" value="{{ $maker->id }}">
                            <button type="submit"><i class="fa fa-binoculars" title="Mutat"></i></button>
                        </form>
                    </div>

                    @if(auth()->check())
                        <div class="col">
                            <a href="{{ route('makers.edit', $maker->id) }}"><button><i class="fa fa-edit edit" title="Módosít"></i></button></a>
                        </div>
                        <div class="col">
                            <form action="{{ route('makers.destroy', $maker->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="btn-del-maker"><i class="fa fa-trash-can trash" title="Töröl"></i></button>
                            </form>
                        </div>
                    @endif
                </div>

            </li>
        @endforeach
    </ul>
    @isset($abc)
        <div class="paginator">
            {{ $makers
                ->appends([
                    'sort_by' => request('sort_by'),
                    'sort_dir' => request('sort_dir'),
                ])
                ->links()

            }}
        </div>
    @endisset
</div>
@endsection
