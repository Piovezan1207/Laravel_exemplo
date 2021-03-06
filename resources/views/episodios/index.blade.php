@extends('layout')

@section('cabecalho')
Episódios
@endsection

@include('mensagem', ['mensagem' => $mensagem])

@section('conteudo') 
<form action="/temporadas/{{ $temporadaId }}/episodios/assistir" method="post">
    @csrf
    <ul class="list-group">
        @foreach ($episodios as $episodio)
        <li class="list-group-item d-flex justify-content-between align-items-center">   
            {{$episodio->numero}} 
        <input type="checkbox" 
            name="episodios[]" 
            value="{{ $episodio->id }}" 
            {{ $episodio->assistido ? 'checked' : '' }}> 
        </li>
        @endforeach
    </ul>
    <button class="btn btn-success mt-2 me-2">Salvar</button>
</form>
@endsection