
@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Edit Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Student</a></li>
                                <li class="breadcrumb-item active">Edit Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{route('etudiants.update', $etudiant->id)}}" method="POST" id="studentForm" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Student Information
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>First Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" placeholder="Enter First Name" value="{{ $etudiant->nom }}">
                                            @error('nom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Last Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" placeholder="Enter Last Name" value="{{ $etudiant->prenom }}">
                                            @error('prenom')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker @error('date_naissance') is-invalid @enderror" name="date_naissance" type="text" placeholder="DD-MM-YYYY" value="{{ $etudiant->date_naissance }}">
                                            @error('date_naissance')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Lieu Of Birth <span class="login-danger">*</span></label>
                                            <input class="form-control  @error('lieu_naissance') is-invalid @enderror" name="lieu_naissance" type="text"  value="{{ $etudiant->lieu_naissance }}">
                                            @error('lieu_naissance')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control form-select select  @error('sexe') is-invalid @enderror" name="sexe">
                                                <option selected disabled>Select Gender</option>
                                                <option value="homme" {{ $etudiant->sexe == 'homme' ? "selected" :""}}>Male</option>
                                                <option value="femme" {{ $etudiant->sexe == 'femme' ? "selected" :""}}>Female</option>
                                            </select>
                                            @error('sexe')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger">*</span></label>
                                            <input type="email" class="form-control @error('email_student') is-invalid @enderror" name="email_student" placeholder="Enter Email_student" value="{{ $etudiant->email }}">
                                            @error('email_student')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">   
                                        <div class="form-group local-forms">
                                            <label>Email Academic<span class="login-danger">*</span></label>
                                            <input type="email" value="{{ $etudiant->user->email }}" class="form-control" name="email" placeholder="Enter Mail">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone </label>
                                            <input class="form-control @error('telephone') is-invalid @enderror" type="text" oninput="this.value = this.value.replace(/[^\d+]/g, '').replace(/^(\+212|0)(\d{9})$/, '$1$2');" name="telephone" placeholder="Enter Phone Number" value="{{ $etudiant->telephone }}">
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger">*</span></label>
                                            <input class="form-control  @error('adresse') is-invalid @enderror" name="adresse" type="text" placeholder="Your Address" value="{{ $etudiant->adresse }}">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <input type="file" class="form-control" name="photo">
                                            @error('photo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Niveau <span class="login-danger">*</span></label>
                                            <select class="form-control form-select select @error('niveau') is-invalid @enderror" name="niveau">
                                                <option selected disabled>Please Select Niveau </option>
                                                @foreach ($niveaux as $niveau)
                                                    <option value="{{ $niveau->id }}" {{ $etudiant->classe->filiere->niveau->nom == $niveau->nom ? "selected" :""}}>{{ $niveau->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('niveau')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Options <span class="login-danger">*</span></label>
                                            <select class="form-control form-select select @error('filiere') is-invalid @enderror" name="filiere">
                                                <option selected disabled>Please Select Option </option>
                                                @foreach ($options as $option)
                                                    <option value="{{ $option->id }}" {{ $etudiant->classe->filiere->id == $option->id ? "selected" :""}}>{{ $option->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('filiere')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control form-select select @error('classe_id') is-invalid @enderror" name="classe_id">
                                                <option selected disabled>Please Select Class </option>
                                                @foreach ($classes as $classe)
                                                    <option value="{{ $classe->id }}" {{ $etudiant->classe->id == $classe->id ? "selected" :""}}>{{ $classe->nom }}</option>
                                                @endforeach
                                            </select>
                                            @error('classe_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <h5 class="form-title parent-info">Parent Information</h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>First Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nom_responsable') is-invalid @enderror" name="nom_responsable" placeholder="Enter First Name" value="{{ $etudiant->responsable->nom }}">
                                            @error('nom_responsable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Last Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('prenom_responsable') is-invalid @enderror" name="prenom_responsable" placeholder="Enter Last Name" value="{{ $etudiant->responsable->prenom }}">
                                            @error('prenom_responsable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control form-select select  @error('sexe_responsable') is-invalid @enderror" name="sexe_responsable">
                                                <option selected disabled>Select Gender</option>
                                                <option value="homme" {{ $etudiant->responsable->sexe == 'homme' ? "selected" :""}}>Male</option>
                                                <option value="femme" {{ $etudiant->responsable->sexe == 'femme' ? "selected" :""}}>Female</option>
                                            </select>
                                            @error('sexe_responsable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>CIN <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('cin') is-invalid @enderror" name="cin" placeholder="Enter cin" value="{{ $etudiant->responsable->cin }}">
                                            @error('cin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone </label>
                                            <input class="form-control @error('telephone_responsable') is-invalid @enderror" type="text" oninput="this.value = this.value.replace(/[^\d+]/g, '').replace(/^(\+212|0)(\d{9})$/, '$1$2');" name="telephone_responsable" placeholder="Enter Phone Number" value="{{ $etudiant->responsable->telephone }}">
                                            @error('telephone_responsable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger">*</span></label>
                                            <input class="form-control  @error('adresse_responsable') is-invalid @enderror" name="adresse_responsable" type="text" placeholder="Your Address" value="{{ $etudiant->responsable->adresse }}">
                                            @error('adresse_responsable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection