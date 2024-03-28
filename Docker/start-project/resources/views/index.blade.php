<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gerenciamento de Atividades Complementares - SIGAC</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/all.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/style.css')}}"/>
    </head>

    <body>
        <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

        <div class="container-fluid justify-content-center">
            <main class="row">
                <section class="col d-flex justify-content-center align-items-center" id="banner-section">
                    <image id="background-image">
                    </image>
                    <div class="justify-content-center align-items-center" id="banner-text">
                        <p class="text-center" id="logo"> SIGAC </p>
                        <small class="text-center" id="sigac-nome-completo"> Sistema de Gerenciamento de Atividades Complementares </small>
                    </div>
                </section>
                <section class="col d-flex align-items-center justify-content-center" id="login-section">
                    <div class="row" id="form-items">
                        <div class="form-outline mb-4">
                            <input type="text" id="usuario" class="form-control" />
                            <label class="form-label" for="usuario">Usuario</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="senha" class="form-control" />
                            <label class="form-label" for="senha">Senha</label>
                        </div>

                        <a class="btn btn-primary" href="{{ route('home') }}">Login</a>
                    </div>
                </section>
            </main>
        </div>

    </body>
	<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

	@yield('script')
</html>
