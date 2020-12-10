<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('profile.edit', [ 
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'trainer_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'string', 'max:50','date'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id}"],
        ];

        // Validate password if has value
        if($request->password)
            $rules['password'] = ['sometimes', 'required', 'string', 'min:8', 'confirmed'];

        $this->validate($request, $rules);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->trainer_name = $request->trainer_name;
        $user->birth_date = $request->birth_date;
        $user->email = $request->email;

        if($request->password)
            $user->password = Hash::make($request->password);

        if($user->isClean())
            return redirect()->back()->with('warning','Done but there are no changes on the account');

        $user->save();
        
        return redirect()->back()->with('success','Account details successfully updated.');

    }
}
