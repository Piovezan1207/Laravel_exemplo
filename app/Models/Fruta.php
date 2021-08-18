<?php 

namespace App\Models;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Model;

class Fruta extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome'];
    //protected $table = 'frutas'; //Serve para encontrar a tabela
    //Porém, pode ser omitido, pois por padrão, o laravel pega o nome da classe, põe a 
    //primeira letra como minuscula e coloca no plural.
}