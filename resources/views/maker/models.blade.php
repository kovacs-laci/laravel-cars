@extends('layout')

@section('content')
<h1>{{ $maker->name }}</h1>
<h2>Modellek</h2>
<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <div>
        @include('success')
        <a href="{{ route('models.create') }}" title="Új">Új hozzáadása</a>
{{--        <br>--}}
{{--        <a href="{{ route('makers.models', ['maker' => $maker, 'sort_by' => 'name', 'sort_dir' => 'asc']) }}" title="ABC">&#11205;</a> / <a href="{{ route('makers.models', ['maker' => $maker, 'sort_by' => 'name', 'sort_dir' => 'desc']) }}" title="ZYX">&#11206;</a>--}}
        <ul>
            @foreach($maker->models as $model)
                <li>
                    <div class="row">
                        <div class="col">{{ $model->id }}</div>
                        <div class="col">{{ $model->name }}</div>
                        <div class="col"><a href="{{ route('models.show', $model->id) }}"><button><i class="fa fa-binoculars" title="Mutat"></i></button></a></div>
                        @if(auth()->check())
                            <div class="col"><a href="{{ route('models.edit', $model->id) }}"><button><i class="fa fa-edit edit" title="Módosít"></i></button></a></div>
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
{{--    <div class="paginator">--}}
{{--        {{ $models--}}
{{--            ->appends([--}}
{{--                'sort_by' => request('sort_by'),--}}
{{--                'sort_dir' => request('sort_dir'),--}}
{{--            ])--}}
{{--            ->links()--}}

{{--        }}--}}
{{--    </div>--}}
</div>
@endsection
