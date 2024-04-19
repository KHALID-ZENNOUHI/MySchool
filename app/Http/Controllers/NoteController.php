<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Activite;
use App\Models\Etudiant;
use App\Models\Matiere;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classe = $request->get('classe_id');
        $notes = Note::where('classe_id', $classe)->get();
        $etudiants = Etudiant::where('classe_id', $classe)->get();
        $matieres = Matiere::all();
        $activities = Activite::where('classe_id', $classe)
                        ->where('type', 'exam')
                        ->get();
        return view('note.index', compact('notes', 'etudiants', 'matieres', 'activities'));
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
    public function store(StoreNoteRequest $request)
    {
        $note = new Note();
        $note->etudiant_id = $request->etudiant_id;
        $note->matiere_id = $request->matiere_id;
        $note->activite_id = $request->activite_id;
        $note->note = $request->note;
        $note->classe_id = $request->classe_id;
        $note->save();
        return redirect()->back()->with('success', 'Note ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
