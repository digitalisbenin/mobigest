
@extends('layouts.admin')
@section('title', 'Points des entrées stock')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h5 class=" mb-0 text-gray-800">POINTS DES  ENTREES  STOCK</h5>
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

                                <div class="col d-flex">
                                    <input type="text" id="searchInput" class="form-control me-2" placeholder="Désignation">
                                    <input type="text" id="searchInputs" class="form-control me-2 " placeholder="IMEI">
                                    <input type="text" id="searchInpute" class="form-control  me-2" placeholder=" Etat">
                                    <input type="text" id="searchCapacite" class="form-control  me-2" placeholder="Capacité">


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
                                    <div class="col-md-10 d-flex align-items-center">
                                        <input type="text" id="searchAuthor" class="form-control  me-3" placeholder="Auteur">
                                        <label class="mt-2">DEBUT
                                        </label>
                                        <input type="date"class="form-control me-3  ml-3" id="startDate">
                                        <label class="mt-2">FIN
                                        </label>
                                        <input type="date" class="form-control ml-3 "id="endDate">
                                        <button type="button" class="btn btn-secondary d-flex ml-3" onclick="window.location='{{ url('dashboard') }}'"> <i class="fas fa-arrow-left mt-1"></i>  Retour</button>
                                    </div>

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
                <tr class="text-center">
                    <td class="category-date">{{ \Carbon\Carbon::parse($article->DateEnreg)->format('d-m-Y') }} {{ $article->HeureEnreg }}</td>
                    <td class="category-title">{{ $article->articlee->Designation }}</td>
                    <td class="category-description"  >{{ $article->IMEI ?? "-"}}</td>
                    <td class="category-etat">{{ $article->Etat ?? "-"  }}</td>
                    <td>{{ $article->Couleur ?? "-" }}</td>
                    <td class="category-capacite">{{ $article->Capacite ?? "-" }}</td>
                    <td>{{ $article->NomFours }}</td>
                    <td>{{ $article->TelFours }}</td>

                    <td>{{ \Carbon\Carbon::parse($article->EntreeLe)->format('d-m-Y') }}  </td>
                    <td>{{$article->quantite == 1 ? '-' : $article->quantite }}</td>
                    <td class="category-author">{{$article->users->name}}


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
    $("#searchInput, #searchInputs, #searchInpute, #searchAuthor,#searchCapacite, #startDate, #endDate").on("keyup change", function() {
        let value = $("#searchInput").val().toLowerCase().trim();
        let value2 = $("#searchInputs").val().toLowerCase().trim();
        let value3 = $("#searchInpute").val().toLowerCase().trim();
        let value4 = $("#searchCapacite").val().toLowerCase().trim();
        let author = $("#searchAuthor").val().toLowerCase().trim(); // Auteur
        let startDate = $("#startDate").val();
        let endDate = $("#endDate").val();
        console.log("Valeurs de recherche :", value, value2, value3, author, startDate, endDate);

        $("#categoryTable tr").each(function() {
            let title = $(this).find(".category-title").text().toLowerCase();
            let description = $(this).find(".category-description").text().toLowerCase();
            let etat = $(this).find(".category-etat").text().toLowerCase();
            let capacite = $(this).find(".category-capacite").text().toLowerCase();
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
            let matches = (title.startsWith(value) || description.startsWith(value) || etat.startsWith(value)) &&
                          (categoryAuthor.startsWith(author) || author === "") &&
                          (description.startsWith(value2) || value2 === "") &&
                          (etat.startsWith(value3) || value3 === "") &&
                          (capacite.startsWith(value4) || value4 === "") &&
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
