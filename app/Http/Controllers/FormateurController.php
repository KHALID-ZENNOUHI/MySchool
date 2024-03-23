<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Http\Requests\StoreFormateurRequest;
use App\Http\Requests\UpdateFormateurRequest;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Formateur::all();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormateurRequest $request)
    {
        $user = User::create([
            'username' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);
        
        $formateur = Formateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'photo' => $request->file('photo')->store('formateurs', 'public'),
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
            'user_id' => $user->id,
        ]);
        return redirect()->route('teachers.index')->with('message', 'Formateur ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formateur $formateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formateur $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormateurRequest $request, Formateur $teacher)
    {
        $teacher->user->update([
            'username' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
        ]);
        
        if ($request->hasFile('photo')) {

            if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
                Storage::disk('public')->delete($teacher->photo);
            }
    
            $image = $request->file('photo')->store('formateurs', 'public');
            $teacher->update([
                'photo' => $image,
            ]);
        }

        $teacher->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,
        ]);

        return redirect()->route('teachers.index')->with('message', 'Formateur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formateur $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('message', 'Formateur supprimé avec succès');
    }
}
