<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PlayerController@home')->name('home');

Route::post('/ingresar-juegos', 'PlayerController@login')->name('login');

Route::get('/registrar-jugador', 'PlayerController@createPlayer')->name('create_player');

Route::post('/guardar-jugador', 'PlayerController@storePlayer')->name('store_player');

Route::post('/registrar-partida-sheldon', 'SheldonController@storeMatchSheldon')->name('store_match_sheldon');

Route::get('/sheldon/{player_name}', 'SheldonController@home')->name('home_sheldon');
