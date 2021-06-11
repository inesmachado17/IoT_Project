<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">SmartHome</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Equipamentos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/actuators/blinds">Persiana</a>
                    <a class="dropdown-item" href="/actuators/air-conditioners">Ar Condicionado</a>
                    <a class="dropdown-item" href="/actuators/sprinklers">Aspersor</a>
                    <a class="dropdown-item" href="/actuators/smoke-alarms">Alarmes de fumaça</a>
                    <a class="dropdown-item" href="/actuators/doors">Porta</a>
                    <a class="dropdown-item" href="/actuators/lamps">Lâmpada</a>
                </div>
            </li>
        </ul>
        <span class="mr-3" style="color: #ffffff80;">
            {{ Auth::user()->email }}
        </span>
        <form class="form-inline my-2 my-lg-0" action="/logout" method="POST">
            @csrf()
            <button type="submit" class="btn btn-outline-light" title="Sair da aplicação">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</nav>
