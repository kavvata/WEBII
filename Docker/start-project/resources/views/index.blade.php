<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Atividades Complementares - SIGAC</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/index.css')}}" />
</head>

<body>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

    <main class="container-fluid d-flex justify-items-center align-items-center">
        <!-- Fixed box container -->
        <div class="container d-flex flex-column justify-content-center align-items-center shadow border rounded" id="main-container">

            <!-- Form Login -->
            <div class="form-group col-auto">
                <input type="text" class="form-control mb-3" placeholder="Usuário">
                <input type="password" class="form-control mb-3" placeholder="Senha">

                <div class="col-auto">
                    <!-- NOTE: rota temporaria -->
                    <a href="{{ route('home') }}" class="btn btn-primary">Entrar</a>
                </div>

            </div>
        </div>
    </main>
</body>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
</html>
