<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }


    // Verifier identi
    public function login(Request $request)
    {
        $user = User::where('login', $request->login)->first();


        if ($user && Hash::check($request->password, $user->password)) {

            session([
                'user_id' => $user->id,
                'login' => $user->login,
                'role' => $user->role
            ]);


            switch($user->role)
            {
                case 'admin':
                    return redirect('/admin/dashboard');

                case 'dcsp':
                    return redirect('/dcsp/dashboard');

                case 'dcoa':
                    return redirect('/dcoa/dashboard');

                case 'dgf':
                    return redirect('/dgf/dashboard');
            }

        }


        return back()->with('error', 'Identifiant ou mot de passe incorrect.');
    }



    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }

}