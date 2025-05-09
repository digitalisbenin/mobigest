
@extends('layouts.admin')
@section('title', 'Depense')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between ">
                        <h5 class=" mb-0 text-gray-800">ENREGISTRER UNE NOUVELLE DEPENSE</h5>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
                               <div class="d-sm-flex align-items-center">
                                <form action="{{ url('depenses') }}" method="GET">

                                    <div class="row mt-0 ">
                                        
                                        
                                        <!-- Date de début -->
                                        <div class="col d-flex ">
                                            <label for="date_debut" class=" form-label mt-2 ml-3">DEBUT</label>
                                            <input type="date" class="form-control ml-2 mt-0" name="date_debut" value="{{ request('date_debut') }}">
                                        </div>
                                
                                        <!-- Date de fin -->
                                        <div class="col d-flex">
                                            <label for="date_fin" class="form-label mt-2 ml-3">FIN</label>
                                            <input type="date" class="form-control ml-2 mt-0" name="date_fin" value="{{ request('date_fin') }}">
                                            
                                        </div>
                                
                                        
                                
                                        <!-- Bouton de soumission -->
                                        <div class="col align-self-end">
                                            <button type="submit" class="btn btn-primary">Filtrer</button>
                                        </div>
                                    </div>
                                </form>
                                {{--  <button type="button"  class="btn btn-secondary " onclick="window.location='{{ url('depenses') }}'">Réinitialiser</button>  --}}
                                 <button class="btn btn-primary ml-4 align-self-start mb-2 " data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>
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
                                                <th>Date & Heure</th>
                                                <th>Motif</th>
                                                <th>Montant</th>
                                                <th>Observations</th>
                                                
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @if($depense->isEmpty())
            <tr>
                <td colspan="5" class="text-center text-muted">Aucune donnée disponible</td>
            </tr>
        @else
      
            @foreach($depense->sortByDesc('created_at') as $article)
                <tr class="text-center" style=" white-space: nowrap;">
                    <td>{{ \Carbon\Carbon::parse($article->DateDepense)->format('d-m-Y') }} {{ $article->HeureDepense }}</td>
                    <td>{{ $article->MotifDepense }}</td>
                    <td class="montant" >{{ number_format($article->MontantDepense, 0, ',', ' ') }} </td>
                    <td>{{ $article->Observations }}</td>
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
                <p>Voulez-vous vraiment supprimer : <strong>{{ $article->MotifDepense }}</strong> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ url('depenses/'.$article->id.'/destroy') }}" method="POST">
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
                <h5 class="modal-title" id="modalModificationLabel{{ $article->id }}">MODIFIER UNE DEPENSE...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('depenses/'.$article->id.'/update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                  
                   <div class="row mb-3">
                            
                            <div class="col">
                                <label class="form-label">Date Enreg.</label>
                                <input type="date" class="form-control" id="dateEnreg" name="DateDepense" value="{{$article->DateDepense}}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Motif de la Dépense</label>
                            <textarea class="form-control" name="MotifDepense" rows="4" >{{$article->MotifDepense}}</textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Montant</label>
                                <input type="number" class="form-control text-end" name="MontantDepense" value="{{$article->MontantDepense}}" >
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Observation</label>
                                <input type="text" class="form-control" name="Observations" value="{{$article->Observations}}">
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
                                        <tfoot class="table-light">
                                            <tr class="text-center fw-bold">
                                                <td colspan="2">TOTAL</td>
                                                <td id="totalMontant">0</td>
                                              
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                        
                                    </table>
                                    <div class="d-flex justify-content-center" >
                                        @if($depense->count()> 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : {{$depense->count()}}</div>
                                   
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
                    <h5 class="modal-title" id="modalLabel">FICHE D'UNE DEPENSE...</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('create-new-entree-depenses') }}" method="post" enctype="multipart/form-data" >
                                        @csrf
                     
                       
<div class="row mb-3">
                            
                            <div class="col">
                                <label class="form-label">Date Enreg.</label>
                                <input type="date" class="form-control" id="dateEnreg" name="DateDepense" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Motif de la Dépense</label>
                            <textarea class="form-control" name="MotifDepense" rows="4" required></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Montant</label>
                                <input type="number" class="form-control text-end" name="MontantDepense" value="0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Observation</label>
                                <input type="text" class="form-control" name="Observations">
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


    <script>
        function calculerTotaux() {
            let totalMontant = 0;
        
            document.querySelectorAll('.montant').forEach(cell => {
                totalMontant += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
            });
           
        
            document.getElementById('totalMontant').innerText = totalMontant.toLocaleString();
           
        }
        
        window.onload = calculerTotaux;
        
    </script>
