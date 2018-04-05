<?php

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

Route::get('mostrarArquivos', 'UploadController@mostrarArquivos');

Route::get('abrir/{nome}', ['uses' => 'ArquivoController@abrirArquivo']);

Route::get('excluir/{nome}', ['uses' => 'ArquivoController@excluirArquivo']);

Route::post('upload', 'UploadController@upload');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
