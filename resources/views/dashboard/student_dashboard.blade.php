
@extends('layouts.master')
@section('content')
    {{-- message --}}
    {{-- {!! Toastr::message() !!} --}}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Welcome {{Session::get('username')}}</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item active">Student</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Week Lessons</h6>
                                    <h3>{{$cours->count()}}</h3>
                                </div>
                                <i class="bi bi-heart"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Week activites</h6>
                                    <h3>{{$activites->count()}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{URL::to('assets/img/icons/teacher-icon-02.svg')}}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>Week Exam</h6>
                                    <h3>{{$exams->count()}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{URL::to('assets/img/icons/student-icon-01.svg')}}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6>All absences</h6>
                                    <h3>{{$absences->count()}}</h3>
                                </div>
                                <div class="db-icon">
                                    <img src="{{URL::to('assets/img/icons/student-icon-02.svg')}}" alt="Dashboard Icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-12 col-xl-8">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title">Notes of {{Session::get('username')}}</h5>
                                    {{-- <ul class="chart-list-out student-ellips">
                                        <li class="star-menus"><a href="javascript:;"><i
                                                    class="fas fa-ellipsis-v"></i></a></li>
                                    </ul> --}}
                                </div>
                                <div class="table-responsive">
                                    <table id="DataList" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread"> 
                                            <tr>
                                                
                                                <th>Subjects</th>
                                                <th>Exam Name</th>   
                                                <th>Note</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notes as $note)
                                            <tr>
                                                
                                                
                                                <td>{{$note->activity->matire->nom}}</td>
                                                <td>{{$note->activity->title}}</td>
                                                <td>{{$note->note}}</td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        
                        <div class="col-12 col-lg-12 col-xl-12 d-flex">
                            <div class="card flex-fill comman-shadow">
                                <div class="card-header d-flex align-items-center">
                                    <h5 class="card-title">Absences of {{Session::get('username')}}</h5>                                
                                </div>
                                <div class="table-responsive">
                                    <table id="DataList" class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread"> 
                                            <tr>
                                                
                                                <th>Date</th>
                                                <th>Cours</th>   
                                                <th>Justification</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($absences as $absence)
                                            <tr>
                                                
                                                <td></td>
                                                <td>{{ $absence->cours->matiere->nom }}
                                                    ({{ $absence->cours->start_datetime }} -
                                                    {{ $absence->cours->end_datetime }})</td>
                                                <td>{{ $absence->justification ? 'Oui' : 'Non' }}</td>
                                                <td>{{ $absence->remarque }}</td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-xl-4 d-flex">
                    <div class="card flex-fill comman-shadow">
                        <div class="card-body">
                            <div id="calendar-doctor" class="calendar-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
