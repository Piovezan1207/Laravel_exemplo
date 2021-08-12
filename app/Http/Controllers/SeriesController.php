<?php

namespace App\Http\Controllers;

use App\Http\Requests\seriesFormRequest;
use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function index(Request $req) {
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

    public function store(seriesFormRequest $req)
    {
        $nome = $req->nome;

        $var = Serie::create([
            'nome' => $nome
        ]);

        $req->session()->flash('mensagem' , "Série {$var->nome} adicionada com sucesso! Id da série: {$var->id}.");
        return redirect()->route('home_series');
        
    }
    public function destroy(Request $req)
    {

        $id = $req->id;
        Serie::destroy($id);

        $req->session()->flash('mensagem' , "Série removida com sucesso!.");
        return redirect()->route('home_series');
    }

}