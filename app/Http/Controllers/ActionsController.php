<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class ActionsController extends Controller
{


    //redirectToFacebook
    function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();

    }

    //handleFacebookCallback
    function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            
            return redirect()->route('login')->with('error', 'Xác thực Facebook thất bại');
        }
        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            //login
            Auth::login($existingUser);

        } else {
            //create
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'username' => $user->getEmail(),
                'password' => bcrypt($user->getEmail())
            ]);
            Auth::login($newUser);
        }


        return redirect(route('homes'));
    }

    //log out
    public function perform()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}