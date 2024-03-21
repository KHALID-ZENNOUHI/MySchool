<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Models\Classe;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\Responsable;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Etudiant::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveaux = Niveau::all();
        $options = Filiere::all();
        $classes = Classe::all();
        return view('student.create', compact('niveaux', 'options', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 4,
        ]);

        $responsable = Responsable::create([
            'nom' => $request->nom_responsable,
            'prenom' => $request->prenom_responsable,
            'cin' => $request->cin,
            'telephone' => $request->telephone_responsable,
            'adresse' => $request->adresse_responsable,
            'sexe' => $request->sexe_responsable,
        ]);

        $student = Etudiant::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email_student,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'sexe' => $request->sexe,
            'classe_id' => $request->classe_id,
            'responsable_id' => $responsable->id,
        ]);

        return redirect()->route('student.index')->with('message', 'Etudiant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }
}
