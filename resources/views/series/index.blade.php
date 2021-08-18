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
        <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                        <input type="text" class="form-control" value="{{ $serie->nome }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                                <i class="fas fa-check"></i>
                            </button>
                            @csrf
                        </div>
                </div>

                <span class="d-flex">
                        <button class="btn btn-info btn-sm me-2" onclick="toggleInput({{ $serie->id }})">
                                <i class="fas fa-edit"></i>
                        </button>
                        <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm me-2">
                        <i class="fas fa-external-link-alt"></i>
                        </a>
                        
                        <form action="/series/remover/{{$serie->id}}" method="post" onsubmit="return confirm('Tem certeza que quer excluir a serie {{$serie->nome}}?')">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                </button> 
                        </form>

                </span>
        </li>
        @endforeach
</ul>

<script>
        function toggleInput(serieId) {
    const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
    const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
    if (nomeSerieEl.hasAttribute('hidden')) {
        nomeSerieEl.removeAttribute('hidden');
        inputSerieEl.hidden = true;
    } else {
        inputSerieEl.removeAttribute('hidden');
        nomeSerieEl.hidden = true;
    }
}

function editarSerie(serieId) {
    let formData = new FormData(); //Vai ser um fomulario enviado pelo javascript
    const nome = document
        .querySelector(`#input-nome-serie-${serieId} > input`) //Pego através do ID de algo, um "filho" (sinalizado pelo >) que seja imnput
        .value;  
    const token = document
        .querySelector(`input[name="_token"]`) //Pega o token que o laravel usa para autenticar o envio do form
        .value;
    formData.append('nome', nome); //Adiciona o Novo nome no form
    formData.append('_token', token); //adiciona o token no form
    const url = `/series/${serieId}/editaNome`; //URL que será enviada esse novo form
    fetch(url, {
        method: 'POST', 
        body: formData
    }).then(() => { //Após fazer o request desse form, esconde o input do texto e atualiza o valor escrito para o novo nome
        toggleInput(serieId);
        document.getElementById(`nome-serie-${serieId}`).textContent = nome;
    });
}


</script>

@endsection