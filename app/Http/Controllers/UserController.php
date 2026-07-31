<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Affichage utilis
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    // Enrg.utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'login' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'nom' => $request->nom,
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }

    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nom' => 'required',
            'login' => 'required|unique:users,login,' . $id,
            'role' => 'required'
        ]);

        $user->nom = $request->nom;
        $user->login = $request->login;
        $user->role = $request->role;

        if ($request->password != "") {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }

    
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé.');
    }
}