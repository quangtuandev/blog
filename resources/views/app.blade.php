<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/images/favicon.ico') }}"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300" rel='stylesheet' type='text/css'>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/font.css') }}" rel="stylesheet">
    <link href="{{ mix('css/auth.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'appName' => config('app.name'),
            'csrfToken' => csrf_token(),
            'locale' => config('app.locale'),
            'fallbackLocale' => config('app.fallback_locale'),
            'url' => url('/'),
            'languages' => config('settings.locale'),
        ]) !!};
        @if (session('access_token'))
            localStorage.setItem('access_token', '{{ session('access_token') }}')
        @endif
    </script>
</head>
</head>

<body>
    <div id="app">
        
    </div>    
    <script src="{{ mix('js/mo.min.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
