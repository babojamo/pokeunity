<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ProfileController;
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


Auth::routes(); 

Route::get('/', function () {
    return redirect()->route('pokemons');
});

Route::middleware('auth')->group(function(){
 

        
    Route::prefix('pokemons')->name('pokemons')->group(function(){

        Route::get('',[PokemonController::class,'list']);
        Route::get('{name}',[PokemonController::class,'show'])->name('.show');
        Route::post('{name}/like',[PokemonController::class,'like'])->name('.reaction.like');
        Route::post('{name}/hate',[PokemonController::class,'hate'])->name('.reaction.hate');
        Route::post('{name}/heart',[PokemonController::class,'heart'])->name('.reaction.heart');
        Route::post('{name}/remove-reaction',[PokemonController::class,'removeReaction'])->name('.reaction.remove');

    });

    Route::get('community',[CommunityController::class,'list'])->name('community');

    Route::prefix('profile')->name('profile')->group(function(){
    
        Route::get('',[ProfileController::class,'edit']);
        Route::post('',[ProfileController::class,'update'])->name('.update');
    
    });

    
});






