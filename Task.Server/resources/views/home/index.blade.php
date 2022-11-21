@extends('layout.master')

@section('content')
<main class="text-center">
    <div class="card m-2">
        <div class="card-body">
            <h5 class="card-title">{{ __('Zadanie 2') }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ __('Zaprojektuj system do uploadu zdjęć:') }}</h6>
            <p class="card-text">{{ __('- dodawanie zdjęcia z nazwa i opisem') }}</p>
            <p class="card-text">{{ __('- wyszukiwanie zdjęć po nazwie') }}</p>
            <p class="card-text">{{ __('- pobieranie danych zdjęcia po id') }}</p>
            <a href="{{ route(RoutingName::PICTURE_INDEX) }}" class="card-link">{{ __('Zobacz') }}</a>
        </div>
    </div>
</main>

@endsection