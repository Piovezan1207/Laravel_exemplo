<?php 

namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class removedorDeSeries  
{
    public function removerSerie(int $serie_id) : string{
        DB::beginTransaction();
            $serie = Serie::find($serie_id);
            $nomeSerie = $serie->nome;
            $this->removerTemporada($serie);
            $serie->delete();
        DB::commit(); 
        return $nomeSerie;
    }

    private function removerTemporada($serie){
        $serie->temporadas->each(function (Temporada $temporada){
          $this->removerEpisodio($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodio($temporada){
        $temporada->episodios()->each(function (Episodio $episodios){
            $episodios->delete();
        });
    }
}
