<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPokemon extends Model
{
    protected $table = "user_pokemons";

    protected $fillable = [
        "user_id",
        "pokemon_id",
        "reaction",
    ];
}
