
@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title"><i class="fas fa-graduation-cap"></i>  Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Student</a></li>
                                <li class="breadcrumb-item active">All Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Students</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('etudiants.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Niveau</th>
                                            <th>Class</th>
                                            <th>Parent Name</th>
                                            <th>Parent Phone</th>
                                            <th>Address</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="student-table-body">
                                        @foreach ($students as $student)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href=""class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle" src="{{ Storage::url($student->photo) }}" alt="User Image">
                                                    </a>
                                                    <a href="">{{ $student->nom }} {{ $student->prenom }}</a>
                                                </h2>
                                            </td>
                                            <td>{{$student->email}}</td>
                                            <td>{{ $student->classe->filiere->niveau->nom }}</td>
                                            <td>{{ $student->classe->nom }}</td>
                                            <td>{{ $student->responsable->nom }} {{ $student->responsable->prenom }}</td>
                                            <td>{{ $student->responsable->telephone }}</td>
                                            <td>{{$student->adresse}}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{route('etudiants.edit', $student->id)}}" class="btn btn-sm bg-danger-light">
                                                        <i class="far fa-edit me-2"></i>
                                                    </a>
                                                    <a class="btn btn-sm bg-danger-light student_delete" data-bs-toggle="modal" data-bs-target="#studentUser{{$student->id}}">
                                                        <i class="far fa-trash-alt me-2"></i>
                                                    </a>
                                                    <a href="{{route('etudiants.show', $student->id)}}" class="btn btn-sm bg-danger-light">
                                                        <i class="fas fa-eye"></i>

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

    {{-- model student delete --}}
    @foreach ($students as $student)
    <div class="modal custom-modal fade" id="studentUser{{$student->id}}" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Student</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <form action="{{ route('etudiants.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="row">
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
    @endforeach
    @section('script')

    {{-- delete js --}}
    <script>
        $(document).on('click','.student_delete',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
            $('.e_avatar').val(_this.find('.avatar').text());
        });
        $(document).ready(function() {
            var table = $('.datatable').DataTable();
            table.destroy(); // Destroy the existing DataTable instance
            $('.datatable').DataTable({
            searching: true, // Enable searching
            // Add other options as needed
            });
        });
    </script>
    @endsection

@endsection
