<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class TemporadasController extends Controller
{
    public function index(Request $req)
    {   
        // Temporada::query()->where('serie_id', $serieId)->get(); //Uma forma de buscar no banco
        $temporadas = Serie::find($req->serieId)->temporadas;
        $serie = Serie::find($req->serieId);
        return (view('temporadas.index', ['serie' => $serie , 'temporadas' => $temporadas]));
    }
}
