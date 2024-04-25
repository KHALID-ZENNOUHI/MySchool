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
                                    @if (Session::get('role_id') === 1 || Session::get('role_id') === 2)
                                    <button type="button" class="btn btn-primary col-auto text-end float-end ms-auto" data-bs-toggle="modal" data-bs-target="#addCoursModal">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="calendar"></div>
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
                        <label class="required" for="start_time">start_time</label>
                        <input class="form-control lesson-timepicker @error('start_datetime') is-invalid @enderror" 
                            type="datetime-local" 
                            name="start_datetime" 
                            id="start_datetime" 
                            value="{{ old('start_datetime') }}" 
                            required>
                        @error('start_datetime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="required" for="start_time">end_time</label>
                        <input class="form-control lesson-timepicker @error('end_datetime') is-invalid @enderror" 
                            type="datetime-local" 
                            name="end_datetime" 
                            id="end_datetime" 
                            value="{{ old('end_datetime') }}" 
                            required>
                        @error('end_datetime')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
<style>
    .fc-event {
        background-color: #808080 !important;
        color: black !important;
    }
</style>
@endsection


    

@section('script')
<script src="{{ url('/assets/fullcalendar/index.global.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek'
            },
            events: @json($events), 
            
                // ... other FullCalendar options ... 
        });
        console.log(@json($events));
        calendar.render();

        
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

