<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador de Depósito</title>

    @include('partials.styles')
</head>
<body>

@include('partials.header')

<main class="container" style="margin-top: 2rem;">
    @yield('content')
</main>
@include('partials.footer')
@include('partials.scripts')
@yield('scripts')
</body>
</html>
