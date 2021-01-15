<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ '' }}">
        <i class="fab fa-rebel"></i>
        <small>VC</small>
    </a>
    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item nav-lg {{ !isset($active) ? 'active' : '' }}">
                <a class="nav-link btn-sm btn-primary" href="{{ route('home.index') }}">
                    <i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li class="nav-item nav-lg {{ isset($active) && $active == 'products' ? 'active' : '' }}">
                <a class="nav-link btn-sm btn-primary" href="{{ route('products.index') }}">
                    <i class="fas fa-cubes"></i>
                    Produtos
                </a>
            </li>
            <li class="nav-item nav-lg {{ isset($active) && $active == 'categories' ? 'active' : '' }}">
                <a class="nav-link btn-sm btn-primary" href="{{ route('categories.index') }}">
                    <i class="fas fa-cube"></i>
                    Categorias
                </a>
            </li>
        </ul>
    </div>
    <div class="btn-group">
        <a class="btn btn-outline-light btn-sm" href="#">
            Olá {{ auth()->user()->firstName() }}
        </a>
    </div>
    <div class="btn-group dropleft">
        <button class="btn btn-outline-light btn-sm" type="button"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-bell"></i>
            <span class="badge badge-light">4</span>
        </button>
        <div class="dropdown-menu">
            <h6 class="dropdown-header">Notificações</h6>
            <a class="btn" href="#" title="My notify"> Notify 1</a>
            <div class="dropdown-divider"></div>
            <a class="btn" href="#" title="My notify"> Notify 2</a>
        </div>
    </div>
    <div class="btn-group dropleft">
        <button class="btn btn-outline-light btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu">
            <h6 class="dropdown-header">Configurações</h6>
            <div class="dropdown-item d-flex justify-content-center">
                <a class="btn" href="{{ route('users.information') }}" title="Informações sobre sua conta.">
                    Conta
                </a>
            </div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-item">
                <a class="btn" href="{{ '#' }}" title="Configuração padrão do sistema.">
                    Preferências
                </a>
            </div>
            <div class="dropdown-divider"></div>
            <div class="dropdown-item d-flex justify-content-center">
                <form class="form-inline my-2 my-lg-0" action="{{ route('users.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn" title="Sair">Sair</button>
                </form>
            </div>
        </div>
    </div>
</nav>