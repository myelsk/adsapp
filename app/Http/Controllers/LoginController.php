<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class LoginController extends Controller
{

    public function store()
    {

        $this->validate(request(), [
            'name' => 'required|min:2',
            'password' => 'required|min:3'
        ]);


        if (User::where('name', '=', Input::get('name'))->count() > 0) {
            if (! auth()->attempt(request(['name', 'password']))) {
                return back()->withErrors([
                    'message' => 'password does not match'
                ]);
            }
        } else {
            $user = User::create([
                'name' => request('name'),
                'password' => bcrypt(request('password'))
            ]);

            auth()->login($user);
        }

        session()->flash('message', 'Thank you for signing up!');
        return redirect()->home();
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
