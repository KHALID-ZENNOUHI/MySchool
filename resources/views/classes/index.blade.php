@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Classes</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Classe</a></li>
                            <li class="breadcrumb-item active">All Classes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- message --}}
        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Phone ...">
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Classes</h3>
                                    </div>
                                    <div class="col-auto text-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-gray me-2">
                                            <i class="fa fa-th" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
                                            <i class="fas fa-plus"></i> Add Class
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if ($classes->count() > 0)
                                    @foreach ($classes as $class)
                                        <div class="col-md-4 col-lg-3 mb-4">
                                            <div class="card-header bg-info text-white fw-bold">
                                                <i class="fas fa-chalkboard-teacher"></i>{{$class->nom}}
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-sitemap"></i> Level: {{$class->filiere->niveau->nom}}</h5>
                                                <p class="card-text"><i class="fas fa-graduation-cap"></i> Option: {{$class->filiere->nom}}</p>
                                                <p class="card-text"><i class="fas fa-user-tie"></i> Coach: {{$class->formateur->nom}}</p>
                                                <p class="card-text"><i class="fas fa-calendar-alt"></i> Promotion: {{$class->anneeScolaire->annee_scolaire_start}}---{{$class->anneeScolaire->annee_scolaire_end}}</p>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <i class="fas fa-users"></i> Total Learners: {{$class->etudiants->count()}}
                                            </div>
                                            <div class="card-footer">
                                                <div class="btn-group" role="group" aria-label="Options">
                                                    <button type="button" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i> Edit</button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-info-circle"></i> Details</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info" role="alert">
                                            No classes found
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for adding classes -->
<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Add Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding classes -->
                <form method="POST" action="{{ route('classes.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="classAnnee_scolaire">Annee_scolaire</label>
                        <select class="form-select" id="classAnnee_scolaire" name="annee_scolaire_id">
                            <option selected>---</option>
                            @foreach($annee_scolaires as $annee_scolaire)
                                <option value="{{ $annee_scolaire->id }}">{{ $annee_scolaire->annee_scolaire_start }}---{{ $annee_scolaire->annee_scolaire_end }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classLevel">Level</label>
                        <select class="form-select" id="classLevel" name="niveau_id">
                            <option selected>---</option>
                            @foreach($niveaux as $level)
                                <option value="{{ $level->id }}">{{ $level->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classOption">Option</label>
                        <select class="form-select" id="classOption" name="filiere_id">
                            <option selected>---</option>
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="className">Class Name</label>
                        <input type="text" class="form-control" name="nom" id="className" placeholder="Enter class name">
                    </div>
                    <div class="form-group">
                        <label for="classCoach">Coach</label>
                        <select class="form-select" id="classCoach" name="formateur_id">
                            <option selected>---</option>
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur->id }}">{{ $formateur->nom }} {{ $formateur->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Move the Submit button inside the form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection