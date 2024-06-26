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
            $cours = Cours::where('classe_id', $classe_id)->where('end_datetime', '>' , now())->get();
        } else {
            $cours = Cours::where('end_datetime', '>' , now())->get();
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
        $start_datetime = $request->start_datetime;
        $end_datetime = $request->end_datetime;
        $classe = $request->classe_id;
        
        $cours = Cours::whereBetween('start_datetime', [$start_datetime, $end_datetime])
            ->orWhereBetween('end_datetime', [$start_datetime, $end_datetime])
            ->orWhere(function($query) use ($start_datetime, $end_datetime) {
                $query->where('start_datetime', '<', $start_datetime)
                    ->where('end_datetime', '>', $end_datetime);
            })->get();
            if ($cours->count() > 0){
                foreach ($cours as $cour) {
                    if ($cour->classe_id == $classe) {
                        return redirect()->route('cours.index')->with('status', 'Cours already exists in this time range for this class.');
                    }
                }
                foreach ($cours as $cour) {
                    if ($cour->formateur_id == $request->formateur_id) {
                        return redirect()->route('cours.index')->with('status', 'The teacher has already a cours in this time range.');
                    }
                }
            }

        Cours::create($request->validated());
        return redirect()->route('cours.index')->with('status', 'Cours created succesfully.');
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
