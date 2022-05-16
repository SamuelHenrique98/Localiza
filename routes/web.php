<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EstoqueController, 
    ZonaController,
    CategoriaController,
    LoteProdutoController,
    ProdutoController,
    CampanhaController,
    VendaController,
    ItensCampanhaController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//ESTOQUE
Route::get('/menu-estoque', function () {
    return view('estoque.menu');
});

Route::resource('estoque', EstoqueController::class);
Route::resource('estoque.zona', ZonaController::class);
Route::resource('categoria', CategoriaController::class);
Route::controller(ProdutoController::class)->group(function(){
    Route::resource('produto', ProdutoController::class);
    Route::post('/produto-import', 'import')->name('produto.import');
});


Route::controller(LoteProdutoController::class)->group(function(){
    Route::get('/depositar', 'deposito')->name("funcao.deposito");
    Route::post('/depositar', 'depositar')->name('funcao.depositar');
    Route::get('/depositar-export', 'export')->name('funcao.depositar-export');
});


Route::get('/buscar',[ProdutoController::class, 'busca'])->name("funcao.busca");
Route::post('/buscar',[ProdutoController::class, 'resultadoBusca'])->name("funcao.resultadoBusca");




//CAMPANHA
Route::get('/menu-campanha', function () {
    return view('campanhas.menu');
});

Route::controller(CampanhaController::class)->group(function(){
    Route::get('/campanha', 'index')->name("campanha.index");
    Route::get('/campanha/create', 'create')->name("campanha.create");
    Route::post('/campanha', 'store')->name("campanha.store");
    Route::delete('/campanha/{campanha}', 'destroy')->name("campanha.destroy");
    Route::get('campanha-export', 'export')->name('campanha.export');
    Route::post('campanha-import', 'import')->name('campanha.import');
    Route::get('/campanha/vendas/{mes}/', 'vendasCampanha')->name('campanha.resultado');
    Route::get('resultado-export', 'exportResultado')->name('resultado.export');
});

Route::get('/campanha/{campanha}/',[ItensCampanhaController::class, 'index'])->name("itens.index");


Route::controller(VendaController::class)->group(function(){
    Route::get('/vendas', 'index')->name("venda.index");
    Route::get('venda-export', 'export')->name('venda.export');
    Route::post('venda-import', 'import')->name('venda.import');
});
