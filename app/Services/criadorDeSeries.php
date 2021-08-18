<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class criadorDeSeries  
{
    public function criarSerie(
        string $nomeSerie, 
        int $qtd_temporadas, 
        int $ep_por_temporada){
        DB::beginTransaction();
            $var = Serie::create(['nome' => $nomeSerie]);
            $this->criarTemporadas($qtd_temporadas,  $ep_por_temporada, $var);
        DB::commit(); //DB::rollBack();
        return $var;
    }

    private function criarTemporadas($qtd_temporadas,  $ep_por_temporada, &$var){
        for($i = 1; $i <= $qtd_temporadas; $i++){
            $temporada = $var->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($ep_por_temporada, $temporada);  
        }
    }

    private function criarEpisodios($ep_por_temporada, $temporada){
        for ($j = 1; $j <= $ep_por_temporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
