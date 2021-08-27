<?php
// WEB
// DB::listen(function($query) {
//     echo "<pre>{$query->sql}</pre>";
// });

//API - TEST
// \DB::listen(function($db) {
//     dump($db->sql);
// });

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

   
});

Route::resource('pokemons', 'PokemonController');
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('trainers', 'TrainerController');
Route::resource('types', 'TypeController');
Route::get('/deleteImagePokemon/{id}', 'PokemonController@deleteImage');