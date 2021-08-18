<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporadaId, Request $req)
    {
        //$Temporada = Temporada::find($temporadaId);
        $episodios = $temporadaId->Episodios;
        return view('episodios.index' ,[
            'episodios' => $temporadaId->episodios,
         'temporadaId' => $temporadaId->id,
         'mensagem' => $req->session()->get('mensagem')
         ]);
    }

    public function assistir(Temporada $temporadaId, Request $req)
    {
        $episodiosAssistidos = $req->episodios;
        $temporadaId->episodios->each(function (Episodio $episodio)
        use ($episodiosAssistidos)
        {
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });

        $temporadaId->push();
        $req->session()->flash('mensagem', 'Episódios marcados como assistidos!');
        return redirect()->back(); // Volta para ultima página
    }
}
