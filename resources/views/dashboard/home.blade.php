
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
                        <h3 class="page-title">Welcome {{ Session::get('username') }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">{{ Session::get('username') }}</li>
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
                                <h6>Students</h6>
                                <h3>{{$etudiants->count()}}</h3>
                            </div>
                            <div class="db-icon">
                                <i class="fas fa-graduation-cap text-dark"></i>
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
                                <h6>Teachers</h6>
                                <h3>{{$formateurs->count()}}</h3>
                            </div>
                            <div class="db-icon">
                                <i class="fas fa-user-tie text-dark"></i>
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
                                <h6>Classes</h6>
                                <h3>{{$classes->count()}}</h3>
                            </div>
                            <div class="db-icon">
                                <i class="fas fa-chalkboard-teacher text-dark"></i>
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
                                <h6>Administrators</h6>
                                <h3>{{$administrators->count()}}</h3>
                            </div>
                            <div class="db-icon">
                                <i class="fas fa-user text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-12 col-lg-6">

                <div class="card card-chart">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h5 class="card-title">Number of Students</h5>
                            </div>
                            <div class="col-6">
                                <ul class="chart-list-out">
                                    <li><span class="circle-blue"></span>Girls</li>
                                    <li><span class="circle-green"></span>Boys</li>
                                    <li class="star-menus"><a href="javascript:;"><i
                                                class="fas fa-ellipsis-v"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- @dd($anneeScolaire) --}}
                    <div id="anneeScolaire" data-anneeScolaire="{{ $anneeScolaire    }}" hidden></div>   
                    <div id="boys" data-boys="{{ $boys }}" hidden></div>   
                    <div id="girls" data-girls="{{ $girls }}" hidden></div>   
                    <div class="card-body">
                        <div id="bar"></div>
                    </div>
                </div>

            </div>
            <div class="col-xl-6 d-flex">

                <div class="card flex-fill student-space comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title">Star 5 Note</h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table star-student table-hover table-center table-borderless table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Note</th>
                                        <th class="text-center">Classe</th>
                                        <th class="text-end">Promotion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($top5Notes) > 0)
                                        @foreach ($top5Notes as $note)
                                            <tr>
                                                
                                                <td class="text-nowrap">
                                                    <h2>{{$note->etudiant->nom}} {{$note->etudiant->prenom}}</h2>
                                                </td>
                                                <td class="text-center">{{$note->note}}</td>
                                                <td class="text-center">{{$note->etudiant->classe->nom}}</td>
                                                <td class="text-end">
                                                    <div>{{$note->etudiant->classe->anneeScolaire->nom}}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No data found</td>
                                        </tr>
                                    @endif

                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">

            <div class="col-xl-6 d-flex">

                <div class="card flex-fill comman-shadow">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title ">Student Activity of today </h5>
                        <ul class="chart-list-out student-ellips">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="activity-groups">
                            @if (count($todayActivities) > 0)
                            <div class="activity-awards">
                                @foreach ($todayActivities as $Activitie)
                                <div class="award-list-outs">
                                        <h4><strong>{{$Activitie->type}}</strong></h4>
                                        <h5>{{$Activitie->title}}</h5>
                                    </div>
                                    <div class="award-time-list">
                                        <span>{{$Activitie->date}}</span>
                                    </div>
                                    @endforeach 
                            </div>
                            @else
                                <div class="activity-awards">
                                    <div class="award-list">
                                        <h4>No Activity</h4>
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
@endsection
