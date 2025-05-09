
@extends('layouts.admin')
@section('title', 'Point des dépense')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class=" mb-0 text-gray-800">POINT DES DEPENSES</h5>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
                                {{--  <form action="{{ url('depenses') }}" method="GET">

                                    <div class="row">
                                        
                                        
                                        <!-- Date de début -->
                                        <div class="col">
                                            <label for="date_debut" class=" form-label">Date Début</label>
                                            <input type="date" class="form-control" name="date_debut" value="{{ request('date_debut') }}">
                                        </div>
                                
                                        <!-- Date de fin -->
                                        <div class="col">
                                            <label for="date_fin" class="form-label">Date Fin</label>
                                            <input type="date" class="form-control" name="date_fin" value="{{ request('date_fin') }}">
                                            
                                        </div>
                                
                                        
                                
                                        <!-- Bouton de soumission -->
                                        <div class="col align-self-end">
                                            <button type="submit" class="btn btn-primary">Filtrer</button>
                                        </div>
                                    </div>
                                </form>
                                 <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>  --}}
                                 <div class="col d-flex">
                                   
                                    
                                    <input type="text" id="searchAuthor" class="form-control me-2 " placeholder="Auteur">
                                  
                                        <label class="mt-2 ml-3">DEBUT
                                        </label>
                                        <input type="date"class="form-control me-3  ml-3" id="startDate">
                                        <label class="mt-2">FIN
                                        </label>
                                        <input type="date" class="form-control ml-3 "id="endDate">
                                        <button type="button" class="btn btn-secondary d-flex ml-3" onclick="window.location='{{ url('dashboard') }}'"> <i class="fas fa-arrow-left mt-1"></i>  Retour</button>
                                   </div>
                                     
                    </div>
             

               
                   

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
                                    <div class="table-responsive" style=" overflow-y: auto; height:410px;">
                                    <table class="table table-bordered table-striped table-hover align-middle">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Date & Heure</th>
                                                <th>Motif</th>
                                                <th>Montant</th>
                                                <th>Observations</th>
                                                
                                                <th>Auteur(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="categoryTable">
                                             @if($depense->isEmpty())
            <tr>
                <td colspan="5" class="text-center text-muted">Aucune donnée disponible</td>
            </tr>
        @else
      
            @foreach($depense->sortByDesc('created_at') as $article)
                <tr class="text-center">
                    <td class="category-date" >{{ \Carbon\Carbon::parse($article->DateDepense)->format('d-m-Y') }} {{ $article->HeureDepense }}</td>
                    <td>{{ $article->MotifDepense }}</td>
                    <td  class="montant" >{{ number_format($article->MontantDepense, 0, ',', ' ') }}  </td>
                    <td>{{ $article->Observations }}</td>
                    <td class="category-author"  >
                        {{ $article->user->name }}
                    </td>
                   
                </tr>



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
                                </div>
                            </div>
                        </div>

                        
                    </div>

                   
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        $(" #searchAuthor, #startDate, #endDate").on("keyup change", function() {
                           
                            let author = $("#searchAuthor").val().toLowerCase().trim(); // Auteur
                            let startDate = $("#startDate").val();
                            let endDate = $("#endDate").val();
                            console.log("Valeurs de recherche :", author, startDate, endDate);
                    
                            $("#categoryTable tr").each(function() {
                              
                                let categoryAuthor = $(this).find(".category-author").text().toLowerCase(); // Auteur dans la ligne
                                let categoryDate = $(this).find(".category-date").text().trim(); // Date dans la ligne
                    
                                console.log("Row Date (original):", categoryDate);
                    
                    
                    
                                let dateValid = true;
                                if (startDate && endDate) {
                                    // Reformater la date en YYYY-MM-DD
                                    let parts = categoryDate.split(" "); // Séparer la date et l'heure
                                    let datePart = parts[0]; // Garder seulement la partie date
                                    let dateParts = datePart.split("-"); // Séparer JJ-MM-AAAA
                    
                                    if (dateParts.length === 3) {
                                        categoryDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`; // Convertir en YYYY-MM-DD
                                    }
                    
                                    let rowDate = new Date(categoryDate);
                                    let start = new Date(startDate);
                                    let end = new Date(endDate);
                    
                                    // Vérifier si la conversion a réussi
                                    if (!isNaN(rowDate)) {
                                        dateValid = rowDate >= start && rowDate <= end;
                                    } else {
                                        dateValid = false; // Si conversion échoue, date invalide
                                    }
                                }
                    
                                // Vérification des critères de recherche
                                let matches = 
                                              (categoryAuthor.startsWith(author) || author === "") &&
                                             
                                              dateValid;
                                              console.log("Row Date:", categoryDate);
                                              console.log("Date valid:", dateValid);
                                              console.log("Matches:", matches);
                                $(this).toggle(matches);
                            });
                        });
                    });
                    </script>
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