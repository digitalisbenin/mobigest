
@extends('layouts.admin')
@section('title', 'Retour au Fournisseur')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between ">
                        <h5 class=" mb-0 text-gray-800">RETOUR AU FOURNISSEUR</h5>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}

                                {{--  <div class="d-flex align-items-center">
                                    <div class="me-3 ">
                                        <select class=" form-control " style="width:200px;">
                                            <option value="IPHONE"> IPHONE
                                            </option>
                                        </select>
                                    </div>
                                    <!-- Champ Date de début -->
                                    <div class="me-3  ">
                                          <label for="date_debut" class="form-label">Du</label>
                                        <input type="date" class="form-control" id="date_debut" name="date_debut">
                                    </div>

                                    <!-- Champ Date de fin -->
                                    <div class="me-3  ">
                                      <label for="date_fin" class="form-label">Au</label>
                                        <input type="date" class="form-control" id="date_fin" name="date_fin">
                                    </div>

                                    <!-- Bouton Nouveau -->
                                      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">
                                        Nouveau
                                    </button>
                                </div>  --}}

                                {{--  <form action="" method="GET">

                                    <div class="row">
                                        <div class="col">
                                            <label for="Id_Article" class="form-label">Article</label>
                                            <select class="form-control" name="Id_Article">
                                                <option value="">Tous</option>
                                                @foreach($articles as $article)
                                                    <option value="{{ $article->IdArticle }}" {{ request('Id_Article') == $article->IdArticle ? 'selected' : '' }}>
                                                        {{ $article->Designation }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="NomFours" class="form-label">Fournisseur</label>
                                            <input type="text" class="form-control" name="NomFours" value="{{ request('NomFours') }}" placeholder="Saisir le nom du fournisseur">
                                        </div>

                                        <!-- Date de début -->
                                        <div class="col">
                                            <label for="date_debut" class="form-label">Date Début</label>
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
                                </form>  --}}


                    </div>




                    <!-- Content Row -->

                      <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                    <form action="" method="GET">

                                        <div class="row">
                                            <div class="col d-flex align-items-center">
                                                <label for="date_debut" class="form-label mt-2 me-2">DEBUT</label>
                                                <input type="date" class="form-control" name="date_debut" value="{{ request('date_debut') }}">
                                            </div>
    
                                            <!-- Date de fin -->
                                            <div class="col d-flex align-items-center ">
                                                <label for="date_fin" class="form-label mt-2 me-2">FIN</label>
                                                <input type="date" class="form-control" name="date_fin" value="{{ request('date_fin') }}">
    
                                            </div>
                                            <div class="col mt-1">
                                               
                                                <input type="text" class="form-control" name="designation" value="{{ request('designation') }}" placeholder="Désignation">
                                            </div>
                                            <div class="col mt-1">

                                                <input type="text" class="form-control" name="imei" value="{{ request('imei') }}" placeholder="IMEI">
                                            </div>
                                            <div class="col mt-1">
                                              
                                                <input type="text" class="form-control" name="etat" value="{{ request('etat') }}" placeholder=" Etat">
                                            </div>
                                            <div class="col mt-1">
                                                
                                                <input type="text" class="form-control" name="capacite" value="{{ request('capacite') }}" placeholder="Capacité">
                                            </div>
    
                                            <!-- Date de début -->
                                           
    
    
    
                                            <!-- Bouton de soumission -->
                                            <div class="col ">
                                                <button type="submit" class="btn btn-primary">Filtrer</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>


                                {{--  <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>


                                </div>  --}}
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive" style=" overflow-y: auto; height:400px;">
                                    <table class="table table-bordered table-striped table-hover align-middle">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th>Date et Heure</th>
                                                <th>Désignation</th>
                                                <th>IMEI</th>
                                                <th>Etat</th>
                                                <th>Couleur</th>
                                                <th>Capacité</th>
                                                <th>Fournisseur</th>
                                                <th>Contact(s)</th>

                                                {{--  <th>Date d'entrée</th>  --}}
                                                {{--  <th>Qte</th>  --}}

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             @if($entreeArticle->isEmpty())
            <tr>
                <td colspan="10" class="text-center text-muted">Aucune donnée disponible</td>
            </tr>
        @else

            @foreach($entreeArticle->sortByDesc('created_at') as $article)
                <tr class="text-center" style=" white-space: nowrap;">
                    <td>{{ \Carbon\Carbon::parse($article->EntreeLe)->format('d-m-Y') }} {{ $article->HeureEnreg }}</td>
                    <td>{{ $article->articlee->Designation }}</td>
                    <td>{{ $article->IMEI ?? "-"}}</td>
                    <td>{{ $article->Etat ?? "-"  }}</td>
                    <td>{{ $article->Couleur ?? "-" }}</td>
                    <td>{{ $article->Capacite ?? "-" }}</td>
                    <td>{{ $article->NomFours }}</td>
                    <td>{{ $article->TelFours }}</td>

                    {{--  <td>{{ \Carbon\Carbon::parse($article->EntreeLe)->format('d-m-Y') }}  </td>  --}}
                    {{--  <td>{{ $article->quantite?? "-"}}</td>  --}}
                    <td>

<a href="#" class="btn btn-sm btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#annulerVenteModal{{ $article->IdEntree }}" data-bs-placement="top" title="Annuler la vente">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
{{--  <a href="#" class="btn btn-sm btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $article->IdEntree }}">
    <i class="bi bi-trash"></i>
</a>  --}}
                        {{--  <a href="#" class="btn btn-sm btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#modalNouvelAccessoire{{ $article->IdEntree }}" data-bs-placement="top" title="Nouvel Accessoire">
                            <i class="bi bi-plus-circle"></i>
                        </a>

    <a href="#" class="btn btn-sm btn-warning mx-1" data-bs-toggle="modal" data-bs-target="#modalModification{{ $article->IdEntree }}" data-bs-placement="top" title="Nouveau Portable"><i class="bi bi-plus-circle"></i></a>  --}}
    {{--  <a href="{{ url('entree-articles/'.$article->IdArticle.'/show') }}" class="btn btn-sm btn-success mx-1"><i class="bi bi-eye"></i></a>  --}}
                        {{--  <a href="#" class="btn btn-sm btn-success mx-1" data-bs-toggle="modal" data-bs-target="#modalModification{{ $article->IdArticle }}">
    <i class="bi bi-pencil"></i>
</a>


                        <a href="{{url('articles/'.$article->IdArticle.'/destroy')}}" class="btn btn-sm btn-danger mx-1"><i class="bi bi-trash"></i></a>  --}}
                    </td>

                </tr>

    <!-- Modal de retour d'article -->
<div class="modal fade" id="annulerVenteModal{{ $article->IdEntree }}" tabindex="-1" aria-labelledby="annulerVenteModalLabel{{ $article->IdEntree }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="annulerVenteModalLabel{{ $article->IdEntree }}">RETOUR ARTICLE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <form action="{{url('create-new-retour-articles')}}" method="POST">
                @csrf


                <div class="modal-body">
                    <div class="mb-3">
                        <label for="DateAnnul" class="form-label">Date Retour</label>
                        <input type="date" name="RetourLe" id="DateAnnul" class="form-control" required>
                        <input type="hidden" name="IdEntree" value="{{ $article->IdEntree }}" id="DateAnnul" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="CauseAnnulat" class="form-label">Observations</label>
                        <textarea name="Observations" style="text-transform: uppercase;" id="CauseAnnulat" class="form-control" rows="3" required placeholder=""></textarea>
                    </div>

                    <!-- Champ pour la date d'annulation -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Retour Article</button>
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
                                        @if($entreeArticle->count()> 0)
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : {{$entreeArticle->count()}}</div>
                                   
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
                        {{--  <div class="mb-3 d-flex">
                            <label for="famille" class="form-label">Famille</label>
                            <select class="form-select" id="famille">
                                <option selected>IPHONE</option>
                            </select>
                             <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn"> <i class="bi bi-plus-circle text-warning"></i></button>
                        </div>  --}}

                        <div class="mb-3 d-flex">
                            <select class="form-select" name="Id_famille" id="famille">
                                {{--  <option selected disabled>Choisir une famille</option>  --}}

                            </select>
                            <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn">
                                <i class="bi bi-plus-circle text-white"></i>
                            </button>
                        </div>


                        <div class="mb-3">
                            <label for="modele" class="form-label">Modèle</label>
                            <input type="text" name="Designation" class="form-control" id="modele">
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
