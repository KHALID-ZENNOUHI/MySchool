@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Classes</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Classe</a></li>
                            <li class="breadcrumb-item active">All Classes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>Class Details</h1>
            </div>
        </div>
    </div> --}}
    <div class="col-auto text-end ms-auto download-grp mb-2">
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nouvelleActiviteModal">
            <i class="fas fa-plus"></i> New Activity
        </button>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-chalkboard-teacher"></i> {{$classe->nom}}
                </div>
                <div class="card-body">
                    <p class="card-text"><i class="fas fa-sitemap"></i> Level: {{$classe->filiere->niveau->nom}}</p>
                    <p class="card-text"><i class="fas fa-graduation-cap"></i> Option: {{$classe->filiere->nom}}</p>
                    <p class="card-text"><i class="fas fa-calendar-alt"></i> Promotion: {{$classe->anneeScolaire->annee_scolaire_start}}---{{$classe->anneeScolaire->annee_scolaire_end}}</p>
                </div>
                <div class="card-footer">
                    <i class="fas fa-users"></i> Total Learners: {{$classe->etudiants->count()}}
                </div>
            </div>
        </div>
        <div class="col-4">
          <div class="card">
              <div class="card-header">
                  <h5 class="card-title">Students</h5>
              </div>
              <ul class="list-group list-group-flush">
                  @if($classe->etudiants->count() == 0)
                      <li class="list-group-item">No student in this class.</li>
                  @else
                      @foreach($classe->etudiants as $etudiant)
                          <li class="list-group-item d-flex align-items-center">
                              <img src="{{ Storage::url($etudiant->photo) }}" 
                                  alt="{{ $etudiant->nom }} {{ $etudiant->prenom }}" 
                                  class="img-thumbnail rounded-circle me-3" 
                                  style="width: 50px; height: 50px;">
                              {{$etudiant->nom}} {{$etudiant->prenom}}
                              <!-- Eye icon link -->
                              <a href="{{route('etudiants.show', $etudiant->id)}}" class="btn btn-sm bg-danger-light ms-auto">
                                  <i class="far fa-eye me-2"></i>
                              </a>
                          </li>
                      @endforeach
                  @endif
              </ul>
          </div>
      </div>
      
        <!-- New Homework Section -->
        <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Activity</h5>
            </div>
            <div class="card-body">
                @if (count($classe->activites) > 0)
                    <ul class="list-group">
                        @foreach($classe->activites as $homework)
                            <li class="list-group-item">
                                <a href="#showInfoModal{{$homework->id}}" data-bs-toggle="modal" data-bs-target="#showInfoModal{{$homework->id}}"><strong>{{$homework->type}}</strong></a>
                                <p class="badge bg-info float-end">{{$homework->title}}</p>
                            </li>
                            <!-- Modal to display information -->
                            <div class="modal fade" id="showInfoModal{{$homework->id}}" tabindex="-1" aria-labelledby="showInfoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="showInfoModalLabel">Stored Information</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <!-- Display stored information here -->
                                    <p><strong>Activity Type:</strong> {{ $homework->type }}</p>
                                    <p><strong>Sujet/Intitulé:</strong> {{ $homework->title }}</p>
                                    <p><strong>Date & Heure:</strong> {{ $homework->date }}</p>
                                    <p><strong>Ressources:</strong> {{ $homework->ressources }}</p>
                                    <p><strong>Description:</strong> {{ $homework->description }}</p>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>No homework assigned yet.</p>
                @endif
            </div>
        </div>
        <!-- End Homework Section -->
    </div>
</div>
<div class="row">
  <div class="col-sm-12">
      <div class="card card-table comman-shadow">
          <div class="card-body">
              <div class="page-header">
                  <div class="row align-items-center">
                      <div class="col">
                          <h3 class="page-title">List of absences</h3>
                      </div>
                      <div class="col-auto text-end float-end ms-auto download-grp" data-bs-toggle="modal" data-bs-target="#absenceModal">
                        <span class="btn btn-primary"><i class="fas fa-plus"></i></span>
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
                              <th>students</th>
                              <th>Seance</th>
                              <th>Remarques</th>
                              <th>Justification</th>
                              <th class="text-end">Action</th>
                          </tr>
                      </thead>
                      <tbody class="student-table-body">
                        @foreach ($classe->cours as $cours)
                        @foreach($cours->absences as $absence)
                          <tr>
                              <td>
                                  <div class="form-check check-tables">
                                      <input class="form-check-input" type="checkbox" value="something">
                                  </div>
                              </td>
                              <td>
                                  <h2 class="table-avatar">
                                      <a href=""class="avatar avatar-sm me-2">
                                          <img class="avatar-img rounded-circle" src="{{ Storage::url($absence->Etudiant->photo) }}" alt="User Image">
                                      </a>
                                      <a href="">{{ $absence->Etudiant->nom }} {{ $absence->Etudiant->prenom }}</a>
                                  </h2>
                              </td>
                              <td>{{ $absence->cours->matiere->nom }} ({{ $absence->cours->start_datetime }} - {{ $absence->cours->end_datetime }})</td> 
                              <td>{{ $absence->remarque }}</td>
                              <td>{{ $absence->justification ? 'Oui' : 'Non' }}</td>
                              <td class="text-end">
                                  <div class="actions">
                                      <span class="btn btn-sm bg-danger-light">
                                          <i class="far fa-edit me-2"></i>
                                      </span>
                                      <!-- Modal absent-->
                                      <div class="modal fade" id="absenceModal" tabindex="-1" aria-labelledby="absenceModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="absenceModalLabel">Formulaire d'absence</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <form method="POST" action="{{route('absence.store')}}">
                                                @csrf
                                                <div class="mb-3">
                                                  <label for="etudiant_id" class="col-form-label">Apprenant:</label>
                                                  <select class="form-select" id="etudiant_id" name="etudiant_id">
                                                    <!-- Add options for learners here -->
                                                    <option selected disabled value="">---</option>
                                                    @foreach($classe->etudiants as $etudiant)
                                                        <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                                                    @endforeach
                                                  </select>
                                                  @error('etudiant_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                  @enderror
                                                </div>
                                                <div class="mb-3">
                                                  <label for="cours_id" class="col-form-label">Seance:</label>
                                                  <select name="cours_id" class="form-select" id="cours_id">
                                                    @if ($classe->cours->count() > 0)
                                                    @foreach($classe->cours as $cour)
                                                    <option value="{{$cour->id}}">{{$cour->matiere->nom}}{{$cour->start_datetime}}-{{$cour->end_datetime}}</option>
                                                    @endforeach
                                                    @else
                                                    <option value="">There is no cours for this class</option>
                                                    @endif
                                                  </select>
                                                  @error('cours_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="mb-3">
                                                  <label for="remarques" class="col-form-label">Remarques:</label>
                                                  <textarea class="form-control" id="remarques" name="remarque"></textarea>
                                                  @error('remarque')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" name="justification" id="justification">
                                                    <label class="form-check-label" for="justification">Justification</label>
                                                    @error('justification')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                                                  <button type="submit" class="btn btn-primary">add</button>
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      {{-- end of modal edit --}}
                                      <a class="btn btn-sm bg-danger-light student_delete" data-bs-toggle="modal" data-bs-target="#studentUser">
                                          <i class="far fa-trash-alt me-2"></i>
                                      </a>
                                      <a href="" class="btn btn-sm bg-danger-light">
                                          <i class="fas fa-eye"></i>

                                      </a>
                                  </div>
                              </td>
                              
                          </tr>
                          @endforeach
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>

  
  <!-- Modal -->
  <div class="modal fade" id="nouvelleActiviteModal" tabindex="-1" aria-labelledby="nouvelleActiviteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nouvelleActiviteModalLabel">New Activity</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('activite.store')}}">
            @csrf
            <input type="hidden" value="{{ $classe->id }}" name="classe_id">
            <!-- Activity Type -->
            <div class="mb-3">
              <label for="activiteType" class="form-label">Activity Type</label>
              <select class="form-select" id="activiteType" name="type" required>
                <option selected disabled value="">--</option>
                <option value="exam">Exam</option>
                <option value="exercice">Exercice</option>
                <option value="avis">Avis</option>
                <!-- Add options here -->
              </select>
                @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!-- matiere id -->
            <div class="mb-3 matiere_id">
              <label for="matiere_id" id="labelMatiere" class="form-label">Subjects</label>
              <select class="form-select" id="matiere_id" name="matiere_id">
                <option selected disabled value="">--</option>
                @foreach($matieres as $matiere)
                    <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
                @endforeach
                <!-- Add options here -->
              </select>
                @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
  
            <!-- Subject/Title -->
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              <!-- Add rich text editor tools here (optional) -->
            </div>
  
            <!-- Date and Time -->
            <div class="mb-3">
              <label for="date" class="form-label">Date & Hour *</label>
              <input type="datetime-local" class="form-control" id="date" name="date" required>
              `@error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
  
            <!-- Resources -->
            <div class="mb-3">
              <label for="ressources" class="form-label">Ressources</label>
              <input type="text" class="form-control" id="ressources" name="ressources" placeholder="Lien: github, notion, google docs, video...">
                @error('ressources')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              <!-- Add link icon or button -->
            </div>
  
            <!-- Remarks -->
            <div class="mb-3">
              <label for="desciprtion" class="form-label">Desciprtion</label>
              <textarea class="form-control" name="description" id="desciprtion" rows="5"></textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  
<!-- Modal absent-->
<div class="modal fade" id="absenceModal" tabindex="-1" aria-labelledby="absenceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="absenceModalLabel">Formulaire d'absence</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{route('absence.store')}}">
            @csrf
            <div class="mb-3">
              <label for="etudiant_id" class="col-form-label">Apprenant:</label>
              <select class="form-select" id="etudiant_id" name="etudiant_id">
                <!-- Add options for learners here -->
                <option selected disabled value="">---</option>
                @foreach($classe->etudiants as $etudiant)
                    <option value="{{$etudiant->id}}">{{$etudiant->nom}} {{$etudiant->prenom}}</option>
                @endforeach
              </select>
              @error('etudiant_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="cours_id" class="col-form-label">Seance:</label>
              <select name="cours_id" class="form-select" id="cours_id">
                @if ($classe->cours->count() > 0)
                @foreach($classe->cours as $cour)
                <option value="{{$cour->id}}">{{$cour->matiere->nom}}{{$cour->start_datetime}}-{{$cour->end_datetime}}</option>
                @endforeach
                @else
                <option value="">There is no cours for this class</option>
                @endif
              </select>
              @error('cours_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="mb-3">
              <label for="remarques" class="col-form-label">Remarques:</label>
              <textarea class="form-control" id="remarques" name="remarque"></textarea>
              @error('remarque')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="justification" id="justification">
                <label class="form-check-label" for="justification">Justification</label>
                @error('justification')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
              <button type="submit" class="btn btn-primary">add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @section('script')
  <script>
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
@endsection
@endsection