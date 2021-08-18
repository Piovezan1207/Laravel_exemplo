<?php

use App\Http\Controllers\EpisodiosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frutasController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;

//Frutas
Route::get('/frutas', [frutasController::class , 'index'])->name('home_frutas');
Route::get('/frutas/criar', [frutasController::class , 'create'])->name('criar_frutas');
Route::post('/frutas/criar', [frutasController::class , 'store'])->name('criar_frutas_post');
Route::post('/frutas/remover/{id}', [frutasController::class , 'destroy'])->name('remover_frutas_post');

//Series
Route::get('/series', [SeriesController::class , 'index'])->name('home_series'); 
Route::get('/series/criar', [SeriesController::class , 'create'])->name('criar_series'); 
Route::post('/series/criar', [SeriesController::class , 'store'])->name('criar_series_post');
Route::post('/series/remover/{id}', [SeriesController::class , 'destroy'])->name('remover_series_post');
Route::post('/series/{id}/editaNome', [SeriesController::class , 'atualize'])->name('atualizar_series_post');


//Temporadas
Route::get('/series/{serieId}/temporadas', [TemporadasController::class , 'index'])->name('ver_temporadas');

//Episódios
Route::get('temporadas/{temporadaId}/episodios', [EpisodiosController::class , 'index'])->name('ver_episodios');
Route::post('/temporadas/{temporadaId}/episodios/assistir', [EpisodiosController::class , 'assistir'])->name('ver_episodios_post');