<nav class="navbar border-bottom navbar-expand-lg bg-body-tertiary ">
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

                @foreach ($roles as $role)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $role['nome'] }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($role['resources'] as $resource)
                        <li><a href="#" class="dropdown-item">{{ $resource['nome'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
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
