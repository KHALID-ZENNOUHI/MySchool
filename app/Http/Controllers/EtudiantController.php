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
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;


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
            'username' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
            'password' => Hash::make('password'),
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
            'photo' => $request->file('photo')->store('students', 'public'),
            'telephone' => $request->has('telephone') ? $request->telephone : null,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'sexe' => $request->sexe,
            'classe_id' => $request->has('classe_id') ? $request->classe_id : null,
            'responsable_id' => $responsable->id,
            'user_id' => $user->id
        ]);
        

        return redirect()->route('etudiants.index')->with('message', 'Etudiant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        return view('student.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        $niveaux = Niveau::all();
        $options = Filiere::all();
        $classes = Classe::all();
        return view('student.edit', compact('etudiant', 'niveaux', 'options', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        $etudiant->user->update([
            'username' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
        ]);

        $etudiant->responsable->update([
            'nom' => $request->nom_responsable,
            'prenom' => $request->prenom_responsable,
            'cin' => $request->cin,
            'telephone' => $request->telephone_responsable,
            'adresse' => $request->adresse_responsable,
            'sexe' => $request->sexe_responsable,
        ]);

        if ($request->hasFile('photo')) {

            if ($etudiant->photo && Storage::disk('public')->exists($etudiant->photo)) {
                Storage::disk('public')->delete($etudiant->photo);
            }
    
            $image = $request->file('photo')->store('images', 'public');
            $etudiant->update([
                'photo' => $image,
            ]);
        }

        $etudiant->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email_student,
            'telephone' => $request->has('telephone') ? $request->telephone : null,
            'adresse' => $request->adresse,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'sexe' => $request->sexe,
            'classe_id' => $request->has('classe_id') ? $request->classe_id : null,
        ]);

        return redirect()->route('etudiants.index')->with('message', 'Etudiant modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        if ($etudiant->photo && Storage::disk('public')->exists($etudiant->photo)) {
            Storage::disk('public')->delete($etudiant->photo);
        }
        $etudiant->delete();
        return redirect()->route('etudiants.index')->with('message', 'Etudiant supprimé avec succès');
    }

    public function studentGrid()
    {
        $students = Etudiant::all();
        return view('student.grid', compact('students'));
    }

    public function searchStudent(Request $request)
    {
        $studentSearch = $request->get('studentSearch', '');
        $students = Etudiant::where('nom', 'like', '%' . $studentSearch . '%')
            ->orWhere('prenom', 'like', '%' . $studentSearch . '%')
            ->with('classe', function ($query) {
                $query->with('filiere', function ($query) {
                    $query->with('niveau');
                });
            })
            ->get();
        return response()->json($students);
    }

    public function getFilieres($niveauId)
    {
        $filieres = Filiere::where('niveau_id', $niveauId)->pluck('nom', 'id');
        return response()->json($filieres);
    }

    public function getClasses($filiereId)
    {
        $classes = Classe::where('filiere_id', $filiereId)->pluck('nom', 'id');
        return response()->json($classes);
    }
}
