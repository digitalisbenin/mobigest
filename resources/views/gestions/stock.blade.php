
@extends('layouts.admin')
@section('title', 'Point des stock')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">POINT DES STOCKS</h1>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}

                                <div class="d-flex align-items-center">
                                    
                                    <div class="col d-flex">
                                        <input type="text" id="searchInput" class="form-control me-2" placeholder="Désignation">
                                        <input type="text" id="searchInputs" class="form-control me-2 " placeholder="Familles">
                                        <button type="button" class="btn btn-secondary d-flex ml-3" onclick="window.location='{{ url('dashboard') }}'"> <i class="fas fa-arrow-left mt-1"></i>  Retour</button>
                                       </div>
                                    
                        {{--  <div>
                            @if($articles->count()> 0)
                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">Total: {{$articles->count()}}</div>
                       
                        @else
                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">Total: 0</div>     
                      
                        @endif
                        </div>  --}}
                                    {{--  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">
                                        Nouveau
                                    </button>  --}}
                                </div>
                    </div>




                    <!-- Content Row -->

                      <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>


                                </div>


                                {{--  <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>


                                </div>  --}}
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive" style=" overflow-y: auto; height:410px;">
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
                                        <tbody id="categoryTable">
                                             @if($articles->isEmpty())
            <tr>
                <td colspan="5" class="text-center text-muted">Aucune donnée disponible</td>
            </tr>
        @else
        @php $counter = 1; @endphp
            @foreach($articles->sortByDesc('created_at') as $article)
                <tr class="text-center">
                    <td>{{ $counter++ }}</td>
                    <td class="category-title">{{ $article->Designation }}</td>
                    <td class="category-description" >{{ $article->famille->LibFamille }}</td>
                    <td>{{ $article->stock_Art }}</td>
                    <td>
                        {{--  @if($article->famille->LibFamille== "ACCESSOIRE") 
                        <a href="#" class="btn btn-sm btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#modalNouvelAccessoire{{ $article->IdArticle }}" data-bs-placement="top" title="Nouvel Accessoire">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                        @else

    <a href="#" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#modalModification{{ $article->IdArticle }}" data-bs-placement="top" title="Nouveau Portable"><i class="bi bi-plus-circle"></i></a>
    @endif  --}}
    <a href="{{ url('detail/'.$article->IdArticle.'/stock') }}" class="btn btn-sm btn-success mx-1"><i class="bi bi-eye"></i></a>
                        {{--  <a href="#" class="btn btn-sm btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalModification{{ $article->IdArticle }}">
    <i class="bi bi-pencil"></i>
</a>


                        <a href="{{url('articles/'.$article->IdArticle.'/destroy')}}" class="btn btn-sm btn-danger mx-1"><i class="bi bi-trash"></i></a>  --}}
                    </td>

                </tr>

<!-- Modal de Ajout de entré article -->
<div class="modal fade" id="modalModification{{ $article->IdArticle }}" tabindex="-1" aria-labelledby="modalModificationLabel{{ $article->IdArticle }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModificationLabel{{ $article->IdArticle }}">FICHE D'ENREGISTREMENT...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('create-new-entree-articles') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="mb-3 col">
                        <label for="modele" class="form-label">Modèle </label>
                        <input type="hidden" name="Id_Article" class="form-control"  value="{{ $article->IdArticle }}">
                        <input type="text" name="Designation" class="form-control" id="modele" value="{{ $article->Designation }}" disabled>
                    </div>
                    <div class="mb-3 col">
                        <label for="modele" class="form-label">Date entrée</label>
                        <input type="date" name="EntreeLe" class="form-control" id="modele" required >
                    </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Nom Fournisseur</label>
                            <input type="text" name="NomFours" class="form-control " value="" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Contacts</label>
                            <input type="number" name="TelFours" class="form-control " value=""required>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Couleur </label>
                            <input type="text" name="Couleur" class="form-control " value="" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Capacité</label>
                            <input type="text" name="Capacite" class="form-control " value="Go" required>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">IMEI</label>
                            <input type="number" name="IMEI" class="form-control " value="" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Etat</label>
                            <select class="form-select" name="Etat" id="famille" required>

                                <option value="Scellé"
                                   >
                                   Scellé
                                </option>
                                <option value="Venu"
                                   >
                                   Venu
                                </option>
                                <option value="Troc/Occasion"
                                   >
                                   Troc/Occasion
                                </option>

                        </select>
                        </div>
                    </div>
                    <div class="row -mb-1">
                        <div class="col">
                            <label class="form-label">Prix d'achat</label>
                            <input type="number" name="PrixAchat" class="form-control text-end" value="">
                        </div>
                        <div class="col">
                            <label class="form-label">Prix de vente</label>
                            <input type="number" name="PrixVente" class="form-control text-end" value="">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Observations</label>
                        <textarea  name="Observations" class="form-control" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalNouvelAccessoire{{ $article->IdArticle }}" tabindex="-1" aria-labelledby="modalNouvelAccessoireLabel{{ $article->IdArticle }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNouvelAccessoireLabel{{ $article->IdArticle }}">AJOUTER UN NOUVEL ACCESSOIRE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('create-new-entree-articles') }}" method="post" enctype="multipart/form-data">
                    @csrf



                    <div class="row">
                        <div class="mb-3 col">
                        <label for="modele" class="form-label">Modèle </label>
                        <input type="hidden" name="Id_Article" class="form-control"  value="{{ $article->IdArticle }}">
                        <input type="text" name="Designation" class="form-control" id="modele" value="{{ $article->Designation }}" disabled>
                    </div>
                    <div class="mb-3 col">
                        <label for="modele" class="form-label">Date entrée</label>
                        <input type="date" name="EntreeLe" class="form-control" id="modele" required >
                    </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Nom Fournisseur</label>
                            <input type="text" name="NomFours" class="form-control " value="" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Contacts</label>
                            <input type="number" name="TelFours" class="form-control " value=""required>
                        </div>
                    </div>




                       


                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Prix d'achat</label>
                            <input type="number" name="PrixAchat" class="form-control text-end" >
                        </div>
                         <div class="col">
                            <label class="form-label">Quantité</label>
                            <input type="number" name="quantite" class="form-control" min="1" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Prix de vente</label>
                            <input type="number" name="PrixVente" class="form-control text-end" >
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Observations</label>
                        <textarea name="Observations" class="form-control" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                   
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

@endsection
