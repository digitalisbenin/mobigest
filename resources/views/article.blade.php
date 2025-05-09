
@extends('layouts.admin')
@section('title', 'Articles')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class=" mb-0 text-gray-800">ENREGISTREMENT D'UN NOUVEAU ARTICLE</h5>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
                              <div>
                                  <a class="btn btn-success" href="{{url('familles')}}">Familles</a>
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
                                    <div class="table-responsive" style=" overflow-y: auto; height:420px;">
                                    <table class="table table-bordered table-striped table-hover align-middle">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>N°</th>
                                                <th>Désignation</th>
                                                <th>Famille</th>
                                                <th>Stock</th>

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
                <tr class="text-center" style=" white-space: nowrap;" >
                    <td>{{ $counter++ }}</td>
                    <td>{{ $article->Designation }}</td>
                    <td>{{ $article->famille->LibFamille }}</td>
                    <td>{{ $article->stock_Art }}</td>
                    <td class="">
                        <a href="#" class="btn btn-sm btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalModification{{ $article->IdArticle }}">
    <i class="bi bi-pencil"></i>
</a>
<a href="#" class="btn btn-sm btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $article->IdArticle }}">
    <i class="bi bi-trash"></i>
</a>
                       {{--  <a href="#" class="btn btn-sm btn-success mx-1" data-bs-toggle="modal{{$article->id}}" data-bs-target="#modalModification{{$article->id}}" ><i class="bi bi-pencil"></i></a>  --}}
                        {{--  <a href="{{url('articles/'.$article->IdArticle.'/destroy')}}" class="btn btn-sm btn-danger mx-1"><i class="bi bi-trash"></i></a>   --}}
                    </td>

                </tr>
<!-- Modal de confirmation -->
<div class="modal fade" id="modalDelete{{ $article->IdArticle }}" tabindex="-1" aria-labelledby="modalDeleteLabel{{ $article->IdArticle }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel{{ $article->IdArticle }}">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Voulez-vous vraiment supprimer : <strong>{{ $article->Designation }}</strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ url('articles/'.$article->IdArticle.'/destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de modification -->
<div class="modal fade" id="modalModification{{ $article->IdArticle }}" tabindex="-1" aria-labelledby="modalModificationLabel{{ $article->IdArticle }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificationLabel{{ $article->IdArticle }}">MODIFIER L'ARTICLE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('articles/'.$article->IdArticle.'/update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 d-flex">
                        <select class="form-select" name="Id_famille" id="famille">
                            @foreach($familles as $famille)
                                <option value="{{ $famille->IDFamille }}"
                                    {{ $famille->IDFamille == $article->Id_famille ? 'selected' : '' }}>
                                    {{ $famille->LibFamille }}
                                </option>
                            @endforeach
                        </select>
                        {{--  <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn">
                            <i class="bi bi-plus-circle text-white"></i>
                        </button>  --}}
                    </div>

                    <div class="mb-3">
                        <label for="modele" class="form-label">Modèle de Téléphone</label>
                        <input type="text" name="Designation" class="form-control" style="text-transform: uppercase;"  id="modele" value="{{ $article->Designation }}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Stock alert</label>
                            <input type="number" name="stock_Alert" class="form-control text-end" value="{{ $article->stock_Alert }}">
                        </div>
                        <div class="col">
                            <label class="form-label">Stock Disponible</label>
                            <input type="number" name="stock_Art" class="form-control text-end" value="{{ $article->stock_Art }}">
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
                    <h5 class="modal-title" id="modalLabel">FICHE D'ENREGISTREMENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('articles') }}" method="post" enctype="multipart/form-data" >
                                        @csrf
                        <label for="famille" class="form-label">Famille</label>


                        <div class="mb-3 d-flex">
                            <select class="form-select" name="Id_famille" id="famille">

                                @foreach($familles as $famille)
                                    <option value="{{ $famille->IDFamille }}">{{ $famille->LibFamille }}</option>
                                @endforeach
                            </select>

                        <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn">
                            <i class="bi bi-plus-circle text-white"></i>
                        </button>
                        </div>


                        <div class="mb-3">
                            <label for="modele" class="form-label">Modèle</label>
                            <input type="text" name="Designation" class="form-control" style="text-transform: uppercase;"  id="modele">

                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Stock alert</label>
                                <input type="number" name="stock_Alert" class="form-control text-end " value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Stock Disponible</label>
                                <input type="number" name="stock_Art" class="form-control text-end" value="0">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Ajouter jQuery via CDN avant ton script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>  --}}
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

    {{--  document.getElementById('ajouterFamilleBtn')?.addEventListener('click', function() {
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
    });  --}}
    {{--  document.getElementById('ajouterFamilleBtn')?.addEventListener('click', function() {
    console.log('Bouton cliqué');  // Vérifier que l'événement se déclenche
    
    let familleInput = document.getElementById('famille');
    let nouvelleFamille = prompt('Veuillez entrer une nouvelle famille:');

    if (nouvelleFamille) {
        nouvelleFamille = nouvelleFamille.toUpperCase(); // Convertir en majuscules
        console.log('Valeur convertie en majuscules:', nouvelleFamille); // Vérifier avant l'affectation
        familleInput.value = nouvelleFamille;
    }
    

        fetch('/ajouter-famille', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ LibFamille: nouvelleFamille }) // Envoyer en majuscule
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
                option.value = data.id; // Assigner la bonne valeur
                familleInput.appendChild(option);
                familleInput.value = data.id; // Sélectionner la nouvelle famille
                familleInput.dispatchEvent(new Event('change'));
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
{{--  
document.getElementById('ajouterFamilleBtn')?.addEventListener('click', function() {
    console.log('Bouton cliqué');  // Vérifier que l'événement se déclenche

    let familleInput = document.getElementById('famille');
    let nouvelleFamille = prompt('Veuillez entrer une nouvelle famille:');

    if (nouvelleFamille) {
        nouvelleFamille = nouvelleFamille.toUpperCase(); // Convertir en majuscule avant l'envoi
       
        fetch('/ajouter-famille', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ LibFamille: nouvelleFamille }) // Envoyer en majuscule
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
                option.value = data.id; // Assigner la bonne valeur
                
                familleInput.appendChild(option); // Ajouter l'option au select
                familleInput.value = data.id; // Sélectionner la nouvelle option ajoutée
                
                console.log('Dernière valeur ajoutée:', data.LibFamille);
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

</script>  --}}

