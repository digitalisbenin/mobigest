
@extends('layouts.admin')
@section('title', 'Rechercher Un Articles')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">RECHERCHER UN  ARTICLE</h1>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
                               <div class="col d-flex">
                                <input type="text" id="searchInput" class="form-control me-2" placeholder="Désignation...">
                                <input type="text" id="searchInputs" class="form-control me-2 " placeholder=" IMEI...">
                                <input type="text" id="searchInpute" class="form-control " placeholder=" Etat ...">
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

                                    <div class="table-responsive" style=" overflow-y: auto; height:420px;">
                                        <table class="table table-bordered table-striped table-hover align-middle">
                                            <thead class="table-primary text-center">
                                                <tr>
                                                    <th>Disponibilités</th>
                                                    <th>Date et Heure</th>
                                                    <th>Désignation</th>
                                                    <th>IMEI</th>
                                                    <th>Etat</th>
                                                    <th>Couleur</th>
                                                    <th>Capacité</th>
                                                    <th>Fournisseur</th>
                                                    <th>Contact(s)</th>
    
                                                    <th>Date d'entrée</th>
                                                    <th>Qte</th>
    
                                                    <th>Auteur(s)</th>
                                                </tr>
                                            </thead>
                                            <tbody id="categoryTable">
                                                 @if($entreeArticle->isEmpty())
                <tr>
                    <td colspan="10" class="text-center text-muted">Aucune donnée disponible</td>
                </tr>
            @else
    
                @foreach($entreeArticle->sortByDesc('created_at') as $article)
                    <tr class="text-center" style=" white-space: nowrap;">
                        <td> {{ $article->Statut }}</td>
                        <td>{{ \Carbon\Carbon::parse($article->DateEnreg)->format('d-m-Y') }} {{ $article->HeureEnreg }}</td>
                        <td class="category-title">{{ $article->articlee->Designation }}</td>
                        <td class="category-description">{{ $article->IMEI ?? "-"}}</td>
                        <td class="category-etat">{{ $article->Etat ?? "-"  }}</td>
                        <td>{{ $article->Couleur ?? "-" }}</td>
                        <td>{{ $article->Capacite ?? "-" }}</td>
                        <td>{{ $article->NomFours }}</td>
                        <td>{{ $article->TelFours }}</td>
    
                        <td>{{ \Carbon\Carbon::parse($article->EntreeLe)->format('d-m-Y') }}  </td>
                        <td>{{ $article->quantite?? "-"}}</td>
                        <td>{{$article->users->name}}
                           
                           
                        </td>
    
                    </tr>
    
    
    
    
    
                @endforeach
            @endif
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center" >
                                        @if($entreeArticle->count()> 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : {{$entreeArticle->count()}}</div>

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
    $("#searchInput, #searchInputs, #searchInpute").on("keyup", function() {
        let value = $(this).val().toLowerCase().trim();

        $("#categoryTable tr").each(function() {
            let title = $(this).find(".category-title").text().toLowerCase();
            let description = $(this).find(".category-description").text().toLowerCase();
            let etat = $(this).find(".category-etat").text().toLowerCase(); // Ajout de la colonne "État"

            $(this).toggle(title.startsWith(value) || description.startsWith(value) || etat.startsWith(value));
        });
    });
});
</script>
                  

                 {{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        let value = $(this).val().toLowerCase().trim();

        $("#categoryTable tr").each(function() {
            let title = $(this).find(".category-title").text().toLowerCase();
            let description = $(this).find(".category-description").text().toLowerCase();

            if (title.includes(value) || description.includes(value)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $("#searchInputs").on("keyup", function() {
        let value = $(this).val().toLowerCase().trim();

        $("#categoryTable tr").each(function() {
            let title = $(this).find(".category-title").text().toLowerCase();
            let description = $(this).find(".category-description").text().toLowerCase();

            if (title.includes(value) || description.includes(value)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
   
   
</script>       --}}

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $("#searchInput").on("keyup", function() {
        let value = $(this).val().toLowerCase();

        $("#categoryTable tr").each(function() {
            let title = $(this).find(".category-title").text().toLowerCase();
            let description = $(this).find(".category-description").text().toLowerCase();

            if (title.includes(value) || description.includes(value)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>

