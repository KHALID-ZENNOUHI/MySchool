
@extends('layouts.master')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title"><i class="fas fa-building"></i>  Administration</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Administration</a></li>
                        <li class="breadcrumb-item active">Administration</li>
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
                                    <h3 class="page-title">administrateur</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    
                                    <a href="{{route('administrateurs.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                        <th>Name</th>
                                        {{-- <th>Class</th> --}}
                                        <th>Gender</th>
                                        <th>Mobile Number</th>
                                        <th>Address</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($administrateurs as $administrateur)
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
                                                    <img class="avatar-img rounded-circle" src="{{Storage::url($administrateur->photo)}}" alt="">
                                                </a>
                                                <a href="#">{{$administrateur->nom}} {{$administrateur->prenom}}</a>
                                            </h2>
                                        </td>
                                        <td>{{$administrateur->sexe}}</td>
                                        <td>{{$administrateur->telephone}}</td>
                                        <td>{{$administrateur->adresse}}</td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{route('administrateurs.edit', $administrateur->id)}}" class="btn btn-sm bg-danger-light">
                                                    <i class="far fa-edit me-2"></i>
                                                </a>
                                                <a class="btn btn-sm bg-danger-light teacher_delete" data-bs-toggle="modal" data-bs-target="#teacherDelete{{$administrateur->id}}">
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
@foreach ($administrateurs as $administrateur)
<div class="modal custom-modal fade" id="teacherDelete{{$administrateur->id}}" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Student</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <form action="{{route('administrateurs.destroy', $administrateur->id)}}" method="POST">
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
@endforeach

@section('script')
    {{-- delete js --}}
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
        });;
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
