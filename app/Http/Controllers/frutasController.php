<?php

namespace App\Http\Controllers;

use App\Fruta;
use App\Http\Requests\frutasFormRequest;
use Fruta as GlobalFruta;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class frutasController extends Controller{
    public function index(Request $req){

        $frutas = Fruta::query()
        ->orderBy('nome')//Ordena por nome
        ->get(); //Busca a tabela inteira de frutas
        //Isso será tratado no HTML, para aparecer apenas os nomes
        
        $mensagem = $req->session()->get('mensagem'); 

        return view('frutas.index', ['frutas' => $frutas , 'mensagem' => $mensagem]);
    }

    public function create(Request $request)
    {
        return view('frutas.create');
    }

    public function store(frutasFormRequest $request)
    {
        $nome = $request->nome; //nome é o campo que vem do navegador através dop input
        
        $var = Fruta::create([ //Dessa forma, você diretamente grava coisas no banco, porém isso deve ser autorizado no eloquent 
            'nome' => $nome 
        ]);

        //Se utilizando do session para mostrar uma mensagem de sucesso
        $request
        ->session()
        //o flah será uma mensagem que vai durar apenas uma sessão e depois será apagada
        ->flash('mensagem',"Fruta {$var->nome} adicionada com sucesso. ID da fruta : {$var->id}");

        return redirect()->route('home_frutas'); //Redireciona para a pagina principal quando é feita a gravação
    }

    public function destroy(Request $req)
    {
        $id = $req->id; 
        $var = Fruta::destroy($id);
        
        $req->session()->flash('mensagem' , 'Fruta deletada com sucesso');
        return redirect()->route('home_frutas');

    }
}