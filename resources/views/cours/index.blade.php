@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Cours</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cours</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Cours</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="teachers.html" class="btn btn-outline-gray me-2 active">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                    <a href="" class="btn btn-outline-gray me-2">
                                        <i class="fa fa-th" aria-hidden="true"></i>
                                    <a href="" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-download"></i> Download</a>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCoursModal">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="DataList" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread"> 
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>classe</th>
                                        {{-- <th>Class</th> --}}
                                        <th>formateur</th>
                                        <th>matiere</th>
                                        <th>jours</th>
                                        <th>start-time</th>
                                        <th>end-time</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cours as $cour)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox"
                                                    value="something">
                                            </div>
                                        </td>
                                        <td>{{$cour->classe->nom}}</td>
                                        <td>{{$cour->formateur->nom}} {{$cour->formateur->prenom}}</td>
                                        <td>{{$cour->matiere->nom}}</td>
                                        <td>{{$cour->jours}}</td>
                                        <td>{{$cour->start_time}}</td>
                                        <td>{{$cour->end_time}}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="" class="btn btn-sm bg-danger-light">
                                                    <i class="far fa-edit me-2"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light teacher_delete" data-bs-toggle="modal" data-bs-target="#teacherDelete">
                                                    <i class="far fa-trash-alt me-2"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding classes -->
<div class="modal fade" id="addCoursModal" tabindex="-1" role="dialog" aria-labelledby="addCoursModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Add Cours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding classes -->
                <form method="POST" action="{{ route('cours.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="classAnnee_scolaire">Classes</label>
                        <select class="form-select" id="classe" name="classe_id">
                            <option selected>---</option>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="classOption">Matieres</label>
                        <select class="form-select" id="matiere" name="matiere_id">
                            <option selected>---</option>
                            @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                            @endforeach
                        </select>
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
                    <div class="form-group">
                        <label for="className">jours</label>
                        <input type="number" class="form-control" name="jours" id="className">
                    </div>
                    <div class="form-group">
                        <label class="required" for="start_time">start_time</label>
                        <input class="form-control lesson-timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" 
                        type="time" 
                        name="start_time" 
                        id="start_time" 
                        value="{{ old('start_time') }}" 
                        required>
                    </div>
                    <div class="form-group">
                        <label class="required" for="start_time">end_time</label>
                        <input class="form-control lesson-timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" 
                        type="time" 
                        name="end_time" 
                        id="end_time" 
                        value="{{ old('end_time') }}" 
                        required>
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