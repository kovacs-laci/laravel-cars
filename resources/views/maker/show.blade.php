@extends('layout')

<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>

@section('content')
    <h1>{{ $maker->name }}</h1>
    @if($maker->logo)
        <img src="{{ asset(env('APP_LOGO_PATH') . $maker->logo) }}" alt="">
    @endif
    <div class="row">
        <div>{{ $maker->id }}</div>
        <div>{{ $maker->name }}</div>

    </div>
    <ul>
        @foreach($models as $model)
            <li>
                <div class="row">
                    <div class="col">{{ $model->id }}</div>
                    <div class="col">{{ $model->name }}</div>


    {{--                    <div class="col"><a href="{{ route('models.show', $model->id) }}"><button><i class="fa fa-binoculars" title="Mutat"></i></button></a></div>--}}
    {{--                    @if(auth()->check())--}}
    {{--                        <div class="col"><a href="{{ route('models.edit', $model->id) }}"><button><i class="fa fa-edit edit" title="Módosít"></i></button></a></div>--}}
    {{--                        <div class="col">--}}
    {{--                            <form action="{{ route('models.destroy', $model->id) }}" method="POST">--}}
    {{--                                @csrf--}}
    {{--                                @method('DELETE')--}}
    {{--                                <button type="submit" name="btn-del-model"><i class="fa fa-trash-can trash" title="Töröl"></i></button>--}}
    {{--                            </form>--}}
    {{--                        </div>--}}
    {{--                    @endif--}}
                </div>
            </li>
        @endforeach
    </ul>
@endsection
