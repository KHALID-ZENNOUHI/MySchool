@extends('layouts.master')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title"><i class="fas fa-chalkboard-teacher"></i> Classes</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Classe</a></li>
                            <li class="breadcrumb-item active">All Classes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <div class="row">
                    <div class="form-group col-md-6 mx-auto">
                        <input type="text" name="search" class="form-control classSearch" placeholder="Search by firstName or lastName or Email...">
                    </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
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
                                        @if (Session::get('role_id') === 1 || Session::get('role_id') === 2)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row classCards">
                                @if ($classes->count() > 0)
                                    @foreach ($classes as $classe)
                                        <div class="col-md-4 col-lg-3 mb-4">
                                            <div class="card-header bg-info text-white fw-bold text-center">
                                                <a href="{{route('classe.show', $classe->id)}}" class="text-white"><i class="fas fa-chalkboard-teacher"></i>{{$classe->nom}}</a>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-title"><i class="fas fa-sitemap"></i> Level: {{$classe->filiere->niveau->nom}}</p>
                                                <p class="card-text"><i class="fas fa-graduation-cap"></i> Option: {{$classe->filiere->nom}}</p>
                                                    <p class="card-text"><i class="fas fa-calendar-alt"></i> Promotion: {{$classe->anneeScolaire->nom}}</p>
                                            </div>
                                            <div class="card-footer text-muted">
                                                <i class="fas fa-users"></i> Total Learners: {{$classe->etudiants->count()}}
                                            </div>
                                            @if (Session::get('role_id') === 1 || Session::get('role_id') === 2)
                                            <div class="card-footer">
                                                <div class="btn-group" role="group" aria-label="Options">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editClassModal{{$classe->id}}"><i class="fas fa-edit"></i> Edit</button>
                                                    
                                                    <form method="POST" action="{{route('classe.destroy', $classe->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                                    </form>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="{{route('classe.show', $classe->id)}}"><i class="fas fa-info-circle"></i> Details</a></button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                                        <a href="{{route('notes.index', ['classe_id' => $classe->id])}}">
                                                            <i class="fas fa-book"></i> Notes 
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                            @elseif (Session::get('role_id') === 3)
                                            <div class="card-footer">
                                                <div class="btn-group" role="group" aria-label="Options">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="{{route('classe.show', $classe->id)}}"><i class="fas fa-info-circle"></i> Details</a></button>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                                        <a href="{{route('notes.index', ['classe_id' => $classe->id])}}">
                                                            <i class="fas fa-book"></i> Notes 
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                            @elseif (Session::get('role_id') === 4)
                                            <div class="card-footer">
                                                <div class="btn-group" role="group" aria-label="Options">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="{{route('classe.show', $classe->id)}}"><i class="fas fa-info-circle"></i> Details</a></button>
                                                    
                                                </div>
                                            </div>
                                            @endif
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
                <form method="POST" action="{{ route('classe.store') }}">
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
                    {{-- <div class="form-group">
                        <label for="classCoach">Coach</label>
                        <select class="form-select" id="classCoach" name="formateur_id">
                            <option selected>---</option>
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur->id }}">{{ $formateur->nom }} {{ $formateur->prenom }}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
<!-- Modal for edit classes -->
@foreach ($classes as $classe)
<div class="modal fade" id="editClassModal{{$classe->id}}" tabindex="-1" role="dialog" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Edit Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('classe.update', $classe->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="classAnnee_scolaire">Annee_scolaire</label>
                        <select class="form-select" id="classAnnee_scolaire" name="annee_scolaire_id">
                            @foreach($annee_scolaires as $annee_scolaire)
                            <option value="{{ $annee_scolaire->id }}" {{ ($classe->anneeScolaire->annee_scolaire_start == $annee_scolaire->annee_scolaire_start && $classe->anneeScolaire->annee_scolaire_end == $annee_scolaire->annee_scolaire_end) ? 'selected' : '' }}>{{ $annee_scolaire->annee_scolaire_start }}---{{ $annee_scolaire->annee_scolaire_end }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classLevel">Level</label>
                        <select class="form-select" id="classLevel" name="niveau_id">
                            @foreach($niveaux as $level)
                                <option value="{{ $level->id }}" {{($classe->filiere->niveau->nom == $level->nom) ? 'selected' : ''}}>{{ $level->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classOption">Option</label>
                        <select class="form-select" id="classOption" name="filiere_id">
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ ($classe->filiere->nom == $filiere->nom) ? 'selected' : '' }}>{{ $filiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="className">Class Name</label>
                        <input type="text" class="form-control" name="nom" id="className" value="{{$classe->nom}}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="classCoach">Coach</label>
                        <select class="form-select" id="classCoach" name="formateur_id">
                            @foreach($formateurs as $formateur)
                                <option value="{{ $formateur->id }}" {{ ($classe->formateur->id == $formateur->id) ? 'selected' : '' }}>{{ $formateur->nom }} {{ $formateur->prenom }}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
@endforeach
<!-- end Modal for edit classes -->

@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var status = '{{ session("status") }}';

    if (status) {
        Swal.fire({
            icon: 'info',
            title: 'info !',
            text: status,
        });
    }
}); 
</script>
@endsection