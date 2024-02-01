@extends('master')
@section('conteudo')

    <div class="container">
        @if (session()->has('messages'))
            <h2>Avisos</h2>
            <div class="alert alert-{{ session('messages')[0] }}">
                <strong>{{ session('messages')[1] }}</strong>
                <hr>
                <a href="/" class="btn btn-primary">Home</a>
                <a href="{{ route('proprietarios') }}" class="btn btn-primary">Proprietários</a>
                <a href="{{ route('veiculos') }}" class="btn btn-primary">Veículos</a>
                <a href="{{ route('revisoes') }}" class="btn btn-primary">Revisões</a>
            </div>
        @else
            <script>window.location = "/";</script>
        @endif 
    </div>
@stop
