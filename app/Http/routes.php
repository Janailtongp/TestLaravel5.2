<?php

/*
pode ser get, pots, any e match
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/sobre/{id}', function ($id) {
    return view('sobre',['id'=>$id]);
});

Route::any('/FLA', function () {
    return '<h1>VAMOS FLAMENGOOOOO</h1>';
})->name('rota.flamengo');

Route::any('/xd', function () {
    return redirect()->route('rota.flamengo');
});

//Recebendo parametros na URL (Opcional)
Route::get('/produto/{idProduto?}', function ($idProduto=0) {
    return "Produto do tipo: {$idProduto}";
});

//Rotas com prefixo 
Route::group(['prefix'=> 'painel'], function(){
	Route::get('/cadastrar', function(){
		return 'cadastro no painel';
	});
	Route::get('/deletar', function(){
		return 'deletar no painel';
	});
	Route::get('/', function(){
		return 'painel index';
	});
});

Route::get('/','SiteController@index');

Route::get('/contato/{id?}','SiteController@contato');
Route::get('/painel/tests','Painel\ProdutoController@tests');
Route::resource('/painel/produtos', 'Painel\ProdutoController');
