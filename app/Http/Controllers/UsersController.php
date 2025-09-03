<?php

namespace App\Http\Controllers;

use App\Models\AgenceTransfert;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        $users = User::where('role', 'Client')->get();
        return view('user.user', [
            "users" => $users,
        ]);
    }

    public function createAdmin()
    {
        $admin = User::where('role', 'Super-admin')->first();

        if($admin)
        {
            return response()->json("Le super administrateur avait déjà été enregistré");
        }

        $admin = User::create([
            'name' => 'MPUKYA KEBO',
            'prenom' => 'Glody',
            'sexe' => 'Masculin',
            'telephone' => '54103099',
            'email' => 'lysiasyannloemba06@gmail.com',
            'role' => 'Super-admin',
            'password' => '12345678',
            'adresse' => 'Bicentenaire',
            'profession'  => 'Etudiant',
            'transfert_argent_id'  => 0,
            'colis_id'  => 0,
            'statut'  => True,
        ]);

        return response()->json('Le super administrateur a été enregistré avec succès');

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agences = AgenceTransfert::all();
        return view('user.forms_user', [
            'agences' => $agences,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'sexe' => 'required|string',
        'telephone' => 'required|string',
        'email' => 'nullable|email|unique:users,email',
        'role' => 'required|string',
        'adresse' => 'nullable|string',
        'profession' => 'nullable|string',
        'agences_transfert_id' => 'required|exists:agences_transfert,id',
    ]);

    $agence = AgenceTransfert::findOrFail(intval($request->agences_transfert_id));

    $user = User::create([
        'name' => $request->name,
        'prenom' => $request->prenom,
        'sexe' => $request->sexe,
        'telephone' => $request->telephone,
        'email' => $request->email,
        'password' => bcrypt('default123'),
        'role' => $request->role,
        'adresse' => $request->adresse,
        'profession' => $request->profession,
        'agences_transfert_id' => $agence->id,
        'statut' => true,
    ]);

    $user->agences()->attach($agence->id);

        return redirect('user/user')->with('success', 'Utilisateur ajouté avec succès.');

}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('agences')->findOrFail($id);
        return view('user.edit_user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
