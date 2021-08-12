@extends('layout')

@section('cabecalho')
Series
@endsection

@if (!@empty($mensagem))

        <div class="alert alert-primary">
                {{$mensagem}}
        </div>
@endif

@section('conteudo')  

<a href="/series/criar" class="btn btn-dark mb-2">Adiconar</a>
<ul class="list-group">
        @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center"> {{$serie->nome}} 
                <form action="/series/remover/{{$serie->id}}" method="post" onsubmit="return confirm('Tem certeza que quer excluir a serie {{$serie->nome}}?')">
                @csrf
                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button> </form>
        </li>
        @endforeach
</ul>
@endsection