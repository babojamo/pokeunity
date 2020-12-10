<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\PokeSource\PokemonReaction;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'first_name', 'last_name', 'trainer_name','birth_date', 'email', 'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'joined_at',
        'name'
    ];

    public function getJoinedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getNameAttribute()
    {
        return ucwords(strtolower($this->first_name)." ".strtolower($this->last_name));
    }

    public function pokemons()
    {
        return $this->hasMany('App\UserPokemon','user_id');
    }


    public function favorite_pokemons()
    {
        return $this->hasMany('App\UserPokemon','user_id')->where('reaction',PokemonReaction::FAVORITE);
    }
    
    public function liked_pokemons()
    {
        return $this->hasMany('App\UserPokemon','user_id')->where('reaction',PokemonReaction::LIKED);
    }

    public function hated_pokemons()
    {
        return $this->hasMany('App\UserPokemon','user_id')->where('reaction',PokemonReaction::HATED);
    }

}
