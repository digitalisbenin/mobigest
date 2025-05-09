
@extends('layouts.admin')
@section('title', 'Accessoire')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class=" mb-0 text-gray-800">AJOUTER UN NOUVEL ACCESSOIRE</h5>
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
                            <div class="card shadow mb-4">
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
                        <div class="mb-3 col">
                        <label for="modele" class="form-label">Modèle </label>
                        <input type="hidden" name="Id_Article" class="form-control"  value="{{ $article->IdArticle ?? "" }}">
                        <input type="text" name="Designation" class="form-control" id="modele" value="{{ $article->Designation ?? "" }}" disabled>
                    </div>
                    <div class="mb-3 col">
                        <label for="modele" class="form-label">Date entrée</label>
                        <input type="date" name="EntreeLe" class="form-control" id="modele" value="{{$entreeAccessoire->EntreeLe ?? ""}}" required >
                    </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Nom Fournisseur</label>
                            <input type="text"  name="NomFours" class="form-control "  style="text-transform: uppercase;" value="{{$entreeAccessoire->NomFours ?? ""}}" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Contacts</label>
                            <input type="number" name="TelFours" class="form-control " value="{{$entreeAccessoire->TelFours ?? ""}}"required>
                        </div>
                    </div>







                    <div class="row mb-1">
                        <div class="col">
                            <label class="form-label">Prix d'achat</label>
                            <input type="number" name="PrixAchat" class="form-control text-end" value="{{$entreeAccessoire->PrixAchat ?? ""}}" >
                        </div>
                         <div class="col">
                            <label class="form-label">Quantité</label>
                            <input type="number" name="quantite" class="form-control"  {{ $entreeAccessoire->quantite ?? "" }} required>
                        </div>
                        <div class="col">
                            <label class="form-label">Prix de vente</label>
                            <input type="number" name="PrixVente" class="form-control text-end" value="{{$entreeAccessoire->PrixVente ?? ""}}" >
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Observations</label>
                        <textarea name="Observations" class="form-control" style="text-transform: uppercase;" rows="3"> {{$entreeAccessoire->Observations ?? ""}}</textarea>
                    </div>

                </div>
                <div class="modal-footer">
                     <button type="submit" class="btn btn-success">Valider</button>
                    {{--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>  --}}

                </div>
            </form>
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


