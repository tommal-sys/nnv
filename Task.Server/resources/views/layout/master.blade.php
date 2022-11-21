<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta-title', AppConfig::getTitle() . ' - ' . AppConfig::getDomain())</title>

    <link rel="preconnect" href="{{ url('/') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preload" href="/font/fontawesome/fa-solid-900.woff2" as="font" crossorigin="anonymous">
    <link rel="preload" href="/font/fontawesome/fa-regular-400.woff2" as="font" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ asset('/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css?v=' . AppConfig::getAppVersion()) }}">

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="/" aria-current="page" href="#">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route(RoutingName::PICTURE_INDEX) }}">{{ __('Zadanie 2') }}</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">

            @if ($errors->any())
            @section('notifications')
            @foreach ($errors->all() as $error)
            <x-notification-view-component :notification="new NotificationDto(NotificationType::ERROR, $error)" />
            @endforeach
            @endsection
            @endif


            <div class="notifications">
                @if (session('notifications'))
                @foreach (session('notifications') as $notification)
                <x-notification-view-component :notification="$notification" />
                @endforeach
                @endif
                @yield('notifications')
            </div>

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    @yield('script')
    <script src="{{ asset('/js/app.js?v=' . AppConfig::getAppVersion()) }}" async defer></script>
</body>

</html>