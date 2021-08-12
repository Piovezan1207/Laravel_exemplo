@extends('layout')

@section('cabecalho')
Adicionar frutas
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('conteudo')  
        <form method="POST" >
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>

            <button class="btn btn-primary">Adicionar</button>

        </form>
@endsection