
@extends('layouts.admin')
@section('title', 'Portable')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-1">
                        <h5 class=" mb-0 text-gray-800"> ENTREE EN STOCK PORTABLE</h5>
                        {{--  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>  --}}
                              <div>

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
                        <div class="col-xl-10 col-lg-10 mx-auto">
                            <div class="card shadow mb-2">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>


                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                   <form action="{{ url('create-new-entree-articles') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="mb-1 col">
                        <label for="modele" class="form-label">Modèle </label>
                        <input type="hidden" name="Id_Article" class="form-control"  value="{{ $article->IdArticle ?? "" }}">
                        <input type="text" name="Designation" class="form-control" id="modele" value="{{ $article->Designation  ?? ""}}" disabled>
                    </div>
                    <div class="mb-1 col">
                        <label for="modele" class="form-label">Date entrée</label>
                        <input type="date" name="EntreeLe" class="form-control" id="modele" required value="{{ $entreePortable->EntreeLe ?? "" }}"  >
                    </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Nom Fournisseur</label>
                            <input type="text" style="text-transform: uppercase;" name="NomFours" class="form-control " value="{{ $entreePortable->NomFours ?? "" }}" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Contacts</label>
                            <input type="number" name="TelFours" class="form-control " value="{{ $entreePortable->TelFours ?? "" }}" required>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Couleur </label>
                            <input type="text" style="text-transform: uppercase;" name="Couleur" class="form-control " value="{{ $entreePortable->Couleur ?? "" }}" >
                        </div>
                        <div class="col">
                            <label class="form-label">Capacité</label>
                            <input type="text" name="Capacite" class="form-control " value="{{ $entreePortable->Capacite ?? "" }}"  >

                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">IMEI</label>
                            <input type="number" name="imei" class="form-control " value="" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Etat</label>
                   <select class="form-select" name="Etat" id="famille">
    <option value="Scellé" @selected(($entreePortable->Etat ?? '') == "Scellé")>Scellé</option>
    <option value="Venu" @selected(($entreePortable->Etat ?? '') == "Venu")>Venu</option>
    <option value="Troc/Occasion" @selected(($entreePortable->Etat ?? '') == "Troc/Occasion")>Troc/Occasion</option>
</select>

                        </div>
                    </div>
                    <div class="row -mb-1">
                        <div class="col">
                            <label class="form-label">Prix d'achat</label>
                            <input type="number" name="PrixAchat" class="form-control text-end" value="{{ $entreePortable->PrixAchat ?? "" }}">
                        </div>
                        <div class="col">
                            <label class="form-label">Prix de vente</label>
                            <input type="number" name="PrixVente" class="form-control text-end" value="{{ $entreePortable->PrixVente ?? "" }}">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Observations</label>
                        <textarea  name="Observations" class="form-control" rows="2">{{ $entreePortable->Observations ?? "" }}</textarea>
                    </div>

                </div>
                <div class="mt-0 text-end mb-2 me-4">
                    <button type="submit" class="btn btn-success ">Valider</button>
                    {{--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>  --}}

                </div>
            </form>
                                </div>


                                </div>
                            </div>
                        </div>


                    </div>



@endsection

