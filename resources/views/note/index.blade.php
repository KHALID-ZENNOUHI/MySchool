@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-clipboard-list"></i>  Notes</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Notes</a></li>
                        <a href="{{route('classe.index')}}"><li class="breadcrumb-item active">All Classes</li></a>
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
                                    {{-- @if ($notes->first()->classe['nom'] !== null) --}}
                                    {{-- <h3 class="page-title">Notes for {{ $notes->first()->classe['nom'] }} class</h3> --}}
                                    {{-- @else --}}
                                    {{-- @endif --}}
                                    <h3 class="page-title">Notes</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp" data-bs-toggle="modal" data-bs-target="#addNotes">
                                    <button class="btn btn-primary"><i class="fas fa-plus"></i></button>
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
                                        <th>Student Name</th>
                                        <th>Subjects</th>
                                        <th>Exam Name</th>   
                                        <th>Note</th>
                                        <th>Address</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox"
                                                    value="something">
                                            </div>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="#" class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" src="{{Storage::url($note->etudiant->photo)}}" alt="">
                                                </a>
                                                <a href="#">{{$note->etudiant->nom}} {{$note->etudiant->prenom}}</a>
                                            </h2>
                                        </td>
                                        <td>{{$note->activity->matire->nom}}</td>
                                        <td>{{$note->activity->title}}</td>
                                        <td></td>
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

{{-- model teacher delete --}}
<div class="modal custom-modal fade" id="teacherDelete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Student</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <input type="hidden" name="id" class="e_user_id" value="">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary continue-btn submit-btn" style="border-radius: 5px !important;">Delete</button>
                            </div>
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal"class="btn btn-primary paid-cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal for add notes --}}
<div class="modal custom-modal fade" id="addNotes" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Notes</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="etudiants" class="form-label">Student Name</label>
                        <select class="form-select" id="etudiants">
                            <option selected disabled>--Select Student--</option>
                            @foreach ($classe->etudiants as $etudiant)
                            <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="matieres" class="form-label">Subject</label>
                        <select class="form-select" id="matieres">
                            <option selected disabled>--Select Subject--</option>
                            @foreach ($matieres as $matiere)
                            <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="activities" class="form-label">Exam</label>
                        <select class="form-select" id="activities">
                            <option selected disabled>--Select Exam--</option>
                            @foreach ($activities as $activity)
                            <option value="{{$activity->id}}">{{$activity->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="note" class="form-label">Note</label>
                        <input type="text" class="form-control" id="note" placeholder="Enter Note">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>                                
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #addNotes .form-group label {
    display: block;
    margin-bottom: 0.5rem; /* Add some space below each label */
    }
    #addNotes span.select2-container {
    width: 100% !important;
    }

</style>


                                    


@section('script')
    <script>
        $(document).on('click','.teacher_delete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_user_id').val(_this.find('.user_id').text());
        });
        $(document).ready(function() {
            var table = $('.datatable').DataTable();
            table.destroy(); // Destroy the existing DataTable instance
            $('.datatable').DataTable({
                searching: true, // Enable searching
                // Add other options as needed
            });
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#etudiants').select2({
                data:[],
                dropdownParent: $('#addNotes form')
            });
            $('#matieres').select2({
                data:[],
                dropdownParent: $('#addNotes form')
            });
            $('#activities').select2({
                data:[],
                dropdownParent: $('#addNotes form')
            });
        });

        
    </script>
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

@endsection

