@extends('layout.master')

@section('content')

<div class="card">
    <img src="{{ url('/images/orginal/'. $model->picture->filename) }}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{ $model->picture->name }}</h5>
        <p class="card-text">{{ $model->picture->description }}</p>
    </div>
</div>

@endsection