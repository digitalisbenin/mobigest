
@extends('layouts.admin')
@section('title', 'Utilisateurs')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class=" mb-0 text-gray-800">ENREGISTRER UN UTILISATEUR</h5>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
                              <div>
                               
                                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>
                              </div>

                    </div>
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




                    <!-- Content Row -->

                      <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>


                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive" style=" overflow-y: auto; height:450px;">
                                    <table class="table table-bordered table-striped table-hover align-middle">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>N°</th>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                           

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @if($articles->isEmpty())
            <tr>
                <td colspan="5" class="text-center text-muted">Aucune donnée disponible</td>
            </tr>
        @else
        @php $counter = 1; @endphp
            @foreach($articles->sortByDesc('created_at') as $article)
                <tr class="text-center">
                    <td>{{ $counter++ }}</td>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->email }}</td>
                    <td>{{ $article->role->name }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalModification{{ $article->id }}">
    <i class="bi bi-pencil"></i>
</a>
<a href="#" class="btn btn-sm btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $article->id }}">
    <i class="bi bi-trash"></i>
</a>
                       {{--  <a href="#" class="btn btn-sm btn-success mx-1" data-bs-toggle="modal{{$article->id}}" data-bs-target="#modalModification{{$article->id}}" ><i class="bi bi-pencil"></i></a>  --}}
                        {{--  <a href="{{url('articles/'.$article->IdArticle.'/destroy')}}" class="btn btn-sm btn-danger mx-1"><i class="bi bi-trash"></i></a>   --}}
                    </td>

                </tr>
<!-- Modal de confirmation -->
<div class="modal fade" id="modalDelete{{ $article->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel{{ $article->id }}">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer : <strong>{{ $article->name }}</strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ url('users/'.$article->id.'/destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de modification -->
<div class="modal fade" id="modalModification{{ $article->id }}" tabindex="-1" aria-labelledby="modalModificationLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificationLabel{{ $article->id }}">MODIFIER UN UTILISATEUR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('users/'.$article->id.'/update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                  
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Stock alert</label>
                            <select class="form-select" name="role_id" id="famille">
                                @foreach($role as $famille)
                                    <option value="{{ $famille->id }}"
                                        {{ $famille->id == $article->role_id ? 'selected' : '' }}>
                                        {{ $famille->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Nom Complet</label>
                            <input type="text" style="text-transform: uppercase;"  name="name" class="form-control " value="{{ $article->name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $article->email }}">
                        </div>
                        <div class="col">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" ">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>


            @endforeach
        @endif
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center" >
                                        @if($articles->count()> 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : {{$articles->count()}}</div>

                                         @else
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : 0</div>

                                         @endif
                                    </div>
                                </div>
                                   <!-- Modal d'enregistrement -->
    <div class="modal fade" id="modalEnregistrement" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">ENREGISTRER UN UTILISATEUR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('users') }}" method="post" enctype="multipart/form-data" >
                                        @csrf
                   

                                        <div class="col mb-2">
                                            <label class="form-label">Role</label>
                                            <select class="form-select" name="role_id" id="famille">
            
                                                @foreach($role as $famille)
                                                    <option value="{{ $famille->id }}">{{ $famille->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                       
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Nom Complet</label>
                                <input type="text" style="text-transform: uppercase;"  name="name" class="form-control "  required>
                            </div>
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control " required >
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Mot de passe</label>
                                <input type="password" name="password" class="form-control "  required>
                            </div>
                            <div class="col">
                                <label class="form-label">Confirmer </label>
                                <input type="password" name="password_confirmation" class="form-control "  required>
                            </div>
                           
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
            </div>
        </div>
    </div>
                                </div>
                            </div>
                        </div>


                    </div>



@endsection
{{--  @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('ajouterFamilleBtn').addEventListener('click', function() {
        let familleInput = document.getElementById('famille');
        let nouvelleFamille = prompt('Veuillez entrer une nouvelle famille:');

        if (nouvelleFamille) {
            fetch('/ajouter-famille', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ LibFamille: nouvelleFamille })
            })
            .then(response => response.json())
            .then(data => {
                let option = document.createElement('option');
                option.textContent = data.LibFamille;
                option.value = data.id;
                familleInput.appendChild(option);
                familleInput.value = data.id;
            })
            .catch(error => console.error('Erreur:', error));
        }
    });
</script>  --}}
{{--  @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>  --}}


