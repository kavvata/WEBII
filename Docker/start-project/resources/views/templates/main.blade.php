<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIGAC  - {{ $titulo }}</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">

                <a href="{{ route('home') }}" class="navbar-brand">SIGAC</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home')}}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administrador
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Coordenadores</a></li>
                                <li><a class="dropdown-item" href="#">Cursos</a></li>
                                <li><a class="dropdown-item" href="#">Eixos</a></li>
                                <li><a class="dropdown-item" href="#">Níveis de Ensino</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Coordenador
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Alunos</a></li>
                                <li><a class="dropdown-item" href="#">Avaliar Horas</a></li>
                                <li><a class="dropdown-item" href="#">Categorias</a></li>
                                <li><a class="dropdown-item" href="#">Grafico Alunos</a></li>
                                <li><a class="dropdown-item" href="#">Grafico Horas</a></li>
                                <li><a class="dropdown-item" href="#">Professores</a></li>
                                <li><a class="dropdown-item" href="#">Relatorio Horas</a></li>
                                <li><a class="dropdown-item" href="#">Turmas</a></li>
                                <li><a class="dropdown-item" href="#">Validar Cadastro</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="dropstart">
                    <a class="dropdown-toggle nav-link" href="#" role="button" data-bs-toggle="dropdown">
                        Usuario
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Configurações do usuário</a></li>
                        <li><a class="dropdown-item" href="#">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('conteudo')
    </body>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

</html>
