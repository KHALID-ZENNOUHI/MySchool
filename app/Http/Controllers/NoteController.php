<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Activite;
use App\Models\Classe;
use App\Models\Etudiant;
use App\Models\Matiere;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classe_id = $request->get('classe_id');
        $notes = Note::where('classe_id', $classe_id)->get();
        $classe = Classe::where('id', $classe_id)->first();
        $matieres = Matiere::all();
        $activities = Activite::where('classe_id', $classe_id)
                        ->where('type', 'exam')
                        ->get();
        return view('note.index', compact('notes', 'classe', 'matieres', 'activities'));
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
        // dd($request->activite_id);
        $idMatiere = Activite::where('id', $request->activite_id)->first();
        // dd($idMatiere->matiere_id);
        $note = new Note();
        $note->etudiant_id = $request->etudiant_id;
        $note->activite_id = $request->activite_id;
        // $note->matiere_id = $idMatiere->matiere_id;
        $note->note = $request->note;
        $note->classe_id = $request->classe_id;
        $note->save();
        return redirect()->back()->with('status', 'Note ajoutée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        
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
