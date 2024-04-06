<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAC - {{ $titulo }}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
</head>

<body>
    <x-navbar :roles="[
    [
      'nome' => 'Administrador',
      'resources' => [
        [
                'nome' => 'Niveis',
                'route' => 'nivel.index'
            ]
        ]
    ]
    ]"></x-navbar>
    @yield('conteudo')
</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

</html>
