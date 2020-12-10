<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CommunityController extends Controller
{
    public function list(Request $request)
    {
        if($request->ajax() || $request->wantsJson())
        {
            $user = auth()->user();

            $search = $request->q;
            $page = $request->page ?? 1;
            
            $users = User::where('id','<>',$user->id);
            $users->with('favorite_pokemons');
            $users->with('liked_pokemons');
            $users->with('hated_pokemons');
            
            $users = $users->paginate(15);

            return response()->json($users);
        }

        return view('community.index');
    }
}
