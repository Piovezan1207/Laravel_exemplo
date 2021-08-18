<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{   
    protected $table = 'episodios';
    public $timestamps = false;
    protected $fillable = ['numero'];
    //protected $guard = [];
    
    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
