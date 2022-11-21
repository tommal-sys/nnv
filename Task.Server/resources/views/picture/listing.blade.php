@extends('layout.master')

@section('content')

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Opis</th>
            <th scope="col">Zdjęcie</th>
            <th scope="col">Akcje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($model->pictures->picturesArray as $picture)
        <tr>
            <th scope="row">{{ $picture->id }}</th>
            <td>{{ $picture->name }}</td>
            <td>{!! $picture->description !!}</td>
            <td><img src="{{ url('/images/thumbnail/'. $picture->filename) }}"></td>
            <td><a href="{{ route(RoutingName::PICTURE_SHOW, ['id' => $picture->id]) }}">Zobacz</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection