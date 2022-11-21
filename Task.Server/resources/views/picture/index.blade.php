@extends('layout.master')

@section('content')
<div class="col-12">
    <div class="col-6">
        <h2 class="m-2">{{ __('Dodaj nowe zdjęcie') }}</h2>
        <form action="{{ route(RoutingName::PICTURE_STORE) }}" method="POST" enctype="multipart/form-data" class="m-2">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{ __('Nazwa') }}</label>
                <input name="name" type="text" class="form-control">
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="description" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">{{ __('Opis') }}</label>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">{{ __('Zdjęcie') }}</label>
                <input name="picture" class="form-control" type="file" id="formFile">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Dodaj') }}</button>
        </form>
    </div>
</div>

<hr>

<div class="col-12">
    <div class="col-6">
        <form action="{{ route(RoutingName::PICTURE_SEARCH) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="search" class="form-label">{{ __('Wyszukaj po nazwie') }}</label>
                <input name="name" type="text" class="form-control" id="search">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Szukaj') }}</button>
        </form>
    </div>
</div>

@endsection