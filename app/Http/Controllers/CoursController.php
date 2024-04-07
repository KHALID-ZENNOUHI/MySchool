<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Formateur;
use App\Models\Matiere;
use App\Models\User;

class CoursController extends Controller
{

    public function index()
    {
        if (session('role') === 'etudiant') {
            $student = Etudiant::where('user_id', session('id'))->first();
            $classe_id = $student->classe_id;
            $cours = Cours::where('classe_id', $classe_id)->get();
        } else {
            $cours = Cours::all();
        }

        $events = [];
        foreach ($cours as $cour) {
            $events[] = [
                'title' => $cour->formateur->nom . ' ' . $cour->formateur->prenom . ' - ' . $cour->matiere->nom,
                'start' => $cour->start_datetime,
                'end' => $cour->end_datetime,
            ];
        }

        $classes = Classe::all();
        $matieres = Matiere::all();
        $formateurs = Formateur::all();

        return view('cours.index', compact(
            'classes', 
            'matieres', 
            'formateurs', 
            'events'
        ));
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
    public function store(StoreCoursRequest $request)
    {
        Cours::create($request->validated());

        return redirect()->route('cours.index')->with('success', 'Cours created succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursRequest $request, Cours $cours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        //
    }
}
