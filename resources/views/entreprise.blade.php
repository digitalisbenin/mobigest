
@extends('layouts.admin')
@section('title', 'Entreprise')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class=" mb-0 text-gray-800">ENREGISTRER UNE ENTREPRISE</h5>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
                                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>

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
                                                {{--  <th>Logo</th>  --}}
                                                <th>N°</th>
                                                <th>Nom Entreprise</th>
                                                <th>Adresse</th>
                                                <th>Email</th>
                                                <th>Téléphone</th>

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
                    <td>{{ $article->NomSociete }}</td>
                    <td>{{ $article->Adresse }}</td>
                    <td>{{ $article->email }}</td>
                    <td>{{ $article->Telephone }}</td>
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
                <p>Voulez-vous vraiment supprimer : <strong>{{ $article->NomSociete }}</strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ url('entreprises/'.$article->id.'/destroy') }}" method="POST">
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
                <h5 class="modal-title" id="modalModificationLabel{{ $article->id }}">MODIFIER UNE ENTREPRISE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('entreprises/'.$article->id.'/update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')




                      <div class="row">
                            <div class="col">
                                <label class="form-label">Nom de l'entreprise</label>
                                <input type="text" name="NomSociete" class="form-control  " style="text-transform: uppercase;" value="{{ $article->NomSociete }}" >
                            </div>
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control " value="{{ $article->email }}" >
                            </div>
                            <div class="col">
                                <label class="form-label">RCCM</label>
                                <input type="text" name="rccm" class="form-control " value="{{ $article->rccm }}" >
                            </div>
                        </div>
                         <div class="row">
                            <div class="col">
                                <label class="form-label">Adresse</label>
                                <input type="text" name="Adresse" class="form-control  "  value="{{ $article->Adresse }}">
                            </div>
                            <div class="col">
                                <label class="form-label">Code Postal</label>
                                <input type="text" name="CodePostal" class="form-control "  value="{{ $article->CodePostal }}">
                            </div>
                            <div class="col">
                                <label class="form-label">Nom du Responsable</label>
                                <input type="text" name="responsable" class="form-control " style="text-transform: uppercase;" value="{{ $article->responsable }}">
                            </div>
                        </div>



                        <div class="row">
                            <div class="col">
                                <label class="form-label">Ville </label>
                                <input type="text" name="Ville" class="form-control  "  value="{{ $article->Ville }}" >
                            </div>
                            <div class="col">
                                <label class="form-label">Téléphone</label>
                                <input type="number" name="Telephone" class="form-control " value="{{ $article->Telephone }}">
                            </div>
                            <div class="col">
                                <label class="form-label">IFU</label>
                                <input type="number" name="ifu" class="form-control " value="{{ $article->ifu }}">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Fax</label>
                                <input type="number" name="Fax" class="form-control  " value="{{ $article->Fax }}">
                            </div>
                            <div class="col">
                                <label class="form-label">Logo</label>
                                <input type="file" name="Logo" class="form-control" value="{{ $article->Logo }}">
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
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES: {{$articles->count()}}</div>

                                         @else
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES: Aucun</div>

                                         @endif
                                    </div>
                                </div>
                                   <!-- Modal d'enregistrement -->
    <div class="modal fade" id="modalEnregistrement" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">ENREGISTRER UNE ENTREPRISE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('entreprises') }}" method="post" enctype="multipart/form-data" >
                                        @csrf

                        <div class="row">
                            <div class="col">
                                <label class="form-label">Nom de l'entreprise</label>
                                <input type="text" name="NomSociete" class="form-control  " style="text-transform: uppercase;" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control "  required>
                            </div>
                            <div class="col">
                                <label class="form-label">RCCM</label>
                                <input type="text" name="rccm" class="form-control "  required>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col">
                                <label class="form-label">Adresse</label>
                                <input type="text" name="Adresse" class="form-control  " value="" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Code Postal</label>
                                <input type="text" name="CodePostal" class="form-control " value="">
                            </div>
                            <div class="col">
                                <label class="form-label">Nom du Responsable</label>
                                <input type="text" name="responsable" class="form-control " value="" required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col">
                                <label class="form-label">Ville </label>
                                <input type="text" name="Ville" class="form-control  " value="">
                            </div>
                            <div class="col">
                                <label class="form-label">Téléphone</label>
                                <input type="number" name="Telephone" class="form-control " value="" required>
                            </div>
                            <div class="col">
                                <label class="form-label">IFU</label>
                                <input type="number" name="ifu" class="form-control " value="" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Fax</label>
                                <input type="number" name="Fax" class="form-control  " >
                            </div>
                            <div class="col">
                                <label class="form-label">Logo</label>
                                <input type="file" name="Logo" class="form-control"  required>
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
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    {{--  document.getElementById('ajouterFamilleBtn')?.addEventListener('click', function() {
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
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur du serveur');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.LibFamille && data.id) {
                    let option = document.createElement('option');
                    option.textContent = data.LibFamille;
                    option.value = data.id;
                    familleInput.appendChild(option);
                    familleInput.value = data.id; // Sélectionner la nouvelle famille
                } else {
                    alert('La famille n\'a pas pu être ajoutée');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
        }
    });  --}}

    document.getElementById('ajouterFamilleBtn')?.addEventListener('click', function() {
        console.log('Bouton cliqué');  // Ajouter cette ligne pour vérifier que l'événement se déclenche
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
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur du serveur');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.LibFamille && data.id) {
                    let option = document.createElement('option');
                    option.textContent = data.LibFamille;
                    option.value = data.id;
                    familleInput.appendChild(option);
                    familleInput.value = data.id; // Sélectionner la nouvelle famille
                } else {
                    alert('La famille n\'a pas pu être ajoutée');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
        }
    });

</script>

