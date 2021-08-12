@extends('layout')

@section('cabecalho')
Frutas
@endsection

@if(!empty($mensagem))
    <div class="alert alert-primary">
        {{$mensagem}}
    </div>
@endif

@section('conteudo')        
        <a href="{{route('criar_frutas')}}" class="btn btn-dark mb-2" >Adicionar</a>

        <ul class="list-group">

            @foreach($frutas as $fruta)
            <li class="list-group-item d-flex justify-content-between align-items-center"> 
                {{$fruta->nome}} 
                <form action="/frutas/remover/{{$fruta->id}}" method="post" onsubmit="return confirm('Tem certeza que quer excluir a fruta {{$fruta->nome}}?')">
                @csrf
                <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                </form>
            </li>    
            @endforeach
        </ul>
@endsection