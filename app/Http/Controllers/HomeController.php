<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Administrateur;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Etudiant;
use App\Models\Formateur;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
        /** home dashboard */
        public function index()
        {
            $classes = Classe::all();
            $formateurs = Formateur::all();
            $etudiants = Etudiant::all();
            $administrators = Administrateur::all();
            $allAnneeScolaire = AnneeScolaire::all();
            $anneeScolaire = [];
            foreach ($allAnneeScolaire as $annee) {
                array_push($anneeScolaire, $annee->nom);
            }

            $boys = [];
            $girls = [];
            $anneeScolaireBoys = 0;
            $anneeScolaireGirls = 0;
            foreach ($allAnneeScolaire as $key => $value) {
                $class = Classe::where('annee_scolaire_id', $value->id)->get();
                if ($class->isEmpty()) {
                    array_push($boys, 0);
                    array_push($girls, 0);
                    continue;
                }
                foreach ($class as $key => $value) {
                    $classBoys = Etudiant::where('classe_id', $value->id)->where('sexe', 'homme')->count();
                    $anneeScolaireBoys += $classBoys;
                    $classGirls = Etudiant::where('classe_id', $value->id)->where('sexe', 'femme')->count();
                    $anneeScolaireGirls += $classGirls;
                }
                array_push($boys, $anneeScolaireBoys);
                array_push($girls, $anneeScolaireGirls);
            }


            $anneeScolaire = json_encode($anneeScolaire);
            $boys = json_encode($boys);
            $girls = json_encode($girls);
            
            $todayActivities = Activite::where('date', Carbon::now()->toDateString())->get();
            $top5Notes = Note::orderBy('note', 'desc')->take(5)->get();

            return view('dashboard.home', compact('classes', 'formateurs', 'etudiants', 'administrators', 'anneeScolaire', 'boys', 'girls', 'todayActivities', 'top5Notes'));
        }
    
        /** profile user */
        public function userProfile()
        {
            return view('dashboard.profile');
        }
    
        /** teacher dashboard */
        public function teacherDashboardIndex()
        {
            $currentDateTime = Carbon::now();
            $startOfWeek = $currentDateTime->startOfWeek();
            $endOfWeek = $currentDateTime->endOfWeek();

            $formateur = Formateur::where('user_id', Session::get('id'))->first();
            $cours = Cours::where('formateur_id', $formateur->id)->whereBetween('start_datetime', [$startOfWeek, $endOfWeek])
                            ->orWhere('end_datetime', [$startOfWeek, $endOfWeek])
                            ->get();
            $activites = Cours::where('formateur_id', $formateur->id)->whereBetween('start_datetime', [$startOfWeek, $endOfWeek])
                            ->orWhere('end_datetime', [$startOfWeek, $endOfWeek])
                            ->get();


            return view('dashboard.teacher_dashboard', compact('cours', 'activites'));
        }
    
        /** student dashboard */
        public function studentDashboardIndex()
        {
            $currentDateTime = Carbon::now();
            $startOfWeek = $currentDateTime->startOfWeek();
            $endOfWeek = $currentDateTime->endOfWeek();

            $etudiant_id = Etudiant::where('user_id', Session::get('id'))->first();
            $notes = Note::where('etudiant_id', $etudiant_id->id)->get();
            

            $classe = Etudiant::where('user_id', Session::get('id'))->first()->classe;
            $cours = Cours::where('classe_id', $classe->id)->whereBetween('start_datetime', [$startOfWeek, $endOfWeek])
                            ->orWhere('end_datetime', [$startOfWeek, $endOfWeek])
                            ->get();
            $activites = Activite::where('classe_id', $classe->id)->whereBetween('date', [$startOfWeek, $endOfWeek])->get();
            $exams = Activite::where('classe_id', $classe->id)->whereBetween('date', [$startOfWeek, $endOfWeek])->where('type', 'exam')->get();
            $absences = Etudiant::where('user_id', Session::get('id'))->first()->absences;
            // $notes = Etudiant::where('user_id', Session::get('id'))->first()->notes;
            return view('dashboard.student_dashboard', compact('cours', 'absences', 'notes', 'activites', 'exams'));
        }
}
