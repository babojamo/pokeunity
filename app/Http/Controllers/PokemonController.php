<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Poke;
use Pokemon;
use App\UserPokemon;
use App\PokeSource\PokemonReaction;

class PokemonController extends Controller
{
    public function list(Request $request)
    {
        if($request->ajax() || $request->wantsJson())
        {
            $search = $request->q;
            $page = $request->page ?? 1;

            if($search) 
                $pokemons = Poke::go()->search($search); // Search pokemon
            else
                $pokemons = Poke::go()->pokemons($page,15); // List all pokemons
                
            return response()->json($pokemons);
        }

        return view('pokemons.index');
    }

    public function show($name)
    {
        $pokemon = Pokemon::spawn($name);
        if($pokemon==null)
            return response()->json(['message'=>'Pokemon could not be found.'],404);

        $user_pokemon = UserPokemon::wherePokemonId($pokemon->name)->first();
        
        return response()->json([
            'info' => $pokemon,
            'user_reaction' => $user_pokemon!=null ? $user_pokemon->reaction : null
        ]);
    }

    public function like($name)
    {
        $pokemon = Pokemon::spawn($name);
        if($pokemon==null)
            return response()->json(['message'=>'Pokemon could not be found.'],404);

        $user = auth()->user();

        $user_poke = UserPokemon::firstOrCreate([
            'pokemon_id' => $pokemon->name,
            'user_id' => $user->id,
        ]);
        $user_poke->reaction = PokemonReaction::LIKED;
        $user_poke->save();

        return 'OK';
    }
    
    public function hate($name)
    {
        $pokemon = Pokemon::spawn($name);
        if($pokemon==null)
            return response()->json(['message'=>'Pokemon could not be found.'],404);

        $user = auth()->user();

        $user_poke = UserPokemon::firstOrCreate([
            'pokemon_id' => $pokemon->name,
            'user_id' => $user->id,
        ]);
        $user_poke->reaction = PokemonReaction::HATED;
        $user_poke->save();

        return 'OK';
    }

    public function heart($name)
    {
        $pokemon = Pokemon::spawn($name);
        if($pokemon==null)
            return response()->json(['message'=>'Pokemon could not be found.'],404);

        $user = auth()->user();

        $user_poke = UserPokemon::firstOrCreate([
            'pokemon_id' => $pokemon->name,
            'user_id' => $user->id,
        ]);
        $user_poke->reaction = PokemonReaction::FAVORITE;
        $user_poke->save();

        return 'OK';
    }

    public function removeReaction($name)
    {
        $pokemon = Pokemon::spawn($name);
        if($pokemon==null)
            return response()->json(['message'=>'Pokemon could not be found.'],404);

        $user = auth()->user();

        $user_poke = UserPokemon::wherePokemonId($pokemon->name)->whereUserId($user->id);
        if($user_poke != null)
            $user_poke->delete();

        return 'OK';
    }
}
