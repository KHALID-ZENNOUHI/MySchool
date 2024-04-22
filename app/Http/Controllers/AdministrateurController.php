<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Http\Requests\StoreAdministrateurRequest;
use App\Http\Requests\UpdateAdministrateurRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdministrateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrateurs = Administrateur::all();
        return view('administration.index', compact('administrateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdministrateurRequest $request)
    {
        $user = User::create([
            'username' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);
        
        $formateur = Administrateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'photo' => $request->file('photo')->store('administrateur', 'public'),
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'user_id' => $user->id,
        ]);
        return redirect()->route('administrateurs.index')->with('status', 'Formateur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrateur $administrateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrateur $administrateur)
    {
        return view('administration.edit', compact('administrateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministrateurRequest $request, Administrateur $administrateur)
    {
        // dd($administrateur);
        $administrateur->user->update([
            'username' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
        ]);
        
        if ($request->hasFile('photo')) {

            if ($administrateur->photo && Storage::disk('public')->exists($administrateur->photo)) {
                Storage::disk('public')->delete($administrateur->photo);
            }
    
            $image = $request->file('photo')->store('formateurs', 'public');
            $administrateur->update([
                'photo' => $image,
            ]);
        }

        $administrateur->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
        ]);

        return redirect()->route('administrateurs.index')->with('status', 'Formateur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrateur $administrateur)
    {
        if ($administrateur->photo && Storage::disk('public')->exists($administrateur->photo)) {
            Storage::disk('public')->delete($administrateur->photo);
        }
        $administrateur->delete();
        return redirect()->route('administrateurs.index')->with('status', 'Formateur supprimé avec succès');
    }
}
