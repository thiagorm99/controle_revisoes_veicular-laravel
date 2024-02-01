<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle Revisões</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <a class="navbar-brand" href="?">Controle Revisão Veicular</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('proprietarios') }}">Gestão</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dash') }}" target="_blank">Gráficos</a>
                    </li>
                @endif
                <li class="nav-item">
                    @if (Auth::check())
                        <a class="nav-link" href="{{ route('sair') }}">Sair</a>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>

    @yield('conteudo')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/code.js') }}"></script>
    <script src="{{ asset('js/proprietario.js') }}"></script>
    <script src="{{ asset('js/veiculo.js') }}"></script>
    <script src="{{ asset('js/revisao.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="application/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>

</html>
