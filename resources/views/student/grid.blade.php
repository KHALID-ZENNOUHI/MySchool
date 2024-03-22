
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

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body pb-0">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Students</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="#" class="btn btn-outline-gray me-2"><i class="fa fa-list"></i></a>
                                        <a href="{{route('students.grid')}}" class="btn btn-outline-gray me-2 active"><i class="fa fa-th"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row text-center">
                                    @foreach ($students as $key=>$list )
                                    <div class="col-lg-2 col-md-4 col-sm-6 mb-5"> <!-- Removed bg-secondary and rounded classes from outer div -->
                                        <div class=" rounded-lg shadow-sm py-4 rounded bg-secondary"> <!-- Changed bg--dark to bg-dark for consistency, added rounded-lg for slightly rounded corners -->
                                            <img src="{{Storage::url($list->photo)}}" alt="" width="100" height="100" style="object-fit: cover;" class="position-relative overflow-hidden rounded-circle mb-3 shadow-sm">
                                            <h6 class="mb-0 text-white text-truncate"><strong>{{$list->nom}} {{$list->prenom}}</strong></h6> <!-- Corrected h6 opening tag -->
                                            <h5 class="text-white">{{$list->classe->filiere->niveau->nom}}</h5>
                                            <h6 class="text-white">{{$list->classe->nom}}</h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
