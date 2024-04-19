<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\AnneeScolaire;
use App\Models\Cours;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Formateur;
use App\Models\Matiere;
use App\Models\Niveau;
use Symfony\Component\HttpFoundation\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        $annee_scolaires = AnneeScolaire::all();
        $classes = Classe::orderBy('updated_at')->get();
        return view('classe.index', compact('filieres', 'niveaux', 'annee_scolaires', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClasseRequest $request)
    {
        Classe::create($request->all());
        return redirect()->route('classe.index')->with('message', 'Classe créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        $matieres = Matiere::all();
        $classe = Classe::findOrFail($classe->id);
        return view('classe.show', compact('classe', 'matieres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        $classe->update($request->all());
        return redirect()->route('classe.index')->with('message', 'Classe modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('classe.index')->with('message', 'Classe supprimée avec succès');
    }

    public function search(Request $request)
    {
        $classSearch = $request->get('classSearch', '');
        $classes = Classe::where('nom', 'like', '%' . $classSearch . '%')
        ->with('filiere', function($query){
            $query->with('niveau');
            })
        ->with('anneeScolaire')
        ->withCount('etudiants')
        ->get();
        
        return response()->json($classes);
    }
}
