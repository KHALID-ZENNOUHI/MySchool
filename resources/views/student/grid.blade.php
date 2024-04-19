
@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Student</a></li>
                                <li class="breadcrumb-item active">All Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="student-group-form">
                <div class="row">
                        <div class="form-group col-md-6 mx-auto">
                            <input type="text" name="search" class="form-control student-search" placeholder="Search by firstName or lastName or Email...">
                        </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="wrapper">
                    <div class="row d-flex flex-wrap gap-3 student-card-container">  
                        @foreach ($students as $key=>$list )
                        <div class="card student-card" style="width: 18rem;">
                            <div class="card-body text-center" bis_skin_checked="1">
                                <img src="{{Storage::url($list->photo)}}" alt="" width="100" height="100" style="object-fit: cover;" class="position-relative overflow-hidden rounded-circle mb-3 shadow-sm">
                                {{-- <img src="" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;"> --}}
                                <h5 class="my-3">{{$list->nom}} {{$list->prenom}}</h5>
                                <p class="text-muted mb-1">{{$list->classe->filiere->niveau->nom}}</p>
                                <p class="text-muted mb-4">{{$list->classe->nom}}</p>
                                <div class="d-flex justify-content-center mb-2" bis_skin_checked="1">
                                {{-- <button type="button" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-primary" data-mdb-button-initialized="true">Follow</button> --}}
                                <a href="{{route('etudiants.show', $list->id)}}"><button type="button" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-outline-primary ms-1" data-mdb-button-initialized="true">Profile</button></a>
                                </div>
                            </div>
                        </div>
                          @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
