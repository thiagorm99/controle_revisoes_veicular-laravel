@extends('master')
@section('conteudo')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Faça login</h3>
                        <form method="post" action="{{ route('logar') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Nome de usuário</label>
                                <input type="text" class="form-control" id="username" name="email"
                                    placeholder="Digite seu nome de usuário" value="admin@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Digite sua senha">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-warning">{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
