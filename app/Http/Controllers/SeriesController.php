<?php

namespace App\Http\Controllers;

use App\Http\Requests\seriesFormRequest;
use App\Models\Serie;
use App\Services\{criadorDeSeries, removedorDeSeries};
use Illuminate\Http\Request;

class SeriesController extends Controller{
    public function index(Request $req) 
    {    
        $series = Serie::query()
        ->orderBy('nome')
        ->get();

        $mensagem = $req->session()->get('mensagem');
        return view('series.index' ,['series' => $series, 'mensagem'=> $mensagem] );
    }

    public function create(Request $req)
    {
        return view('series.create');
    }

    public function store(seriesFormRequest $req, criadorDeSeries $criarSerie)
    {
        $var = $criarSerie->criarSerie($req->nome, $req->qtd_temporadas, $req->ep_por_temporada);
        $req->session()->flash('mensagem' , "Série {$var->nome} adicionada com sucesso! Id da série: {$var->id}.");
        return redirect()->route('home_series');   
    }
    public function destroy(Request $req, removedorDeSeries $removerSerie)
    {
        $nomeSerie = $removerSerie->removerSerie($req->id);
        $req->session()->flash('mensagem' , "Série $nomeSerie removida com sucesso!.");
        return redirect()->route('home_series');
    }

    public function atualize(Request $req)
    {
        $novoNome = $req->nome;
        $serie = Serie::find($req->id);
        $serie->nome = $novoNome;
        $serie->save();
    }    

}