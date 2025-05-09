
@extends('layouts.admin')
@section('title', 'Point des Ventes Annulées')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h5 class=" mb-0 text-gray-800">POINT DES VENTES ANNULEES</h5>
                        
                            {{--  <button type="button" class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#venteAccessoireModal">
                                Vendre un Accessoire
                            </button>


                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#venteModal">
                                Vendre un Portable
                            </button>  --}}

                            
                            {{--  <form action="{{ url('ventes-article') }}" method="GET">

                                <div class="row">
                                    
                                    
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
                                <input type="text" id="searchInpute" class="form-control  me-2" placeholder="Etat">
                                
                                <input type="text" id="searchAuthor" class="form-control " placeholder="Auteur">
    
                               </div>
                            
                    </div>




                    <!-- Content Row -->

                      <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-1">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                    <div class="col-md-8 d-flex align-items-center">
                                        <input type="text" id="searchCapacite" class="form-control  me-2" placeholder="Client">
                                        <label class="mt-2">DEBUT
                                        </label>
                                        <input type="date"class="form-control me-3  ml-3" id="startDate">
                                        <label class="mt-2">FIN
                                        </label>
                                        <input type="date" class="form-control ml-3 "id="endDate">
                                        <button type="button" class="btn btn-secondary d-flex ml-3" onclick="window.location='{{ url('dashboard') }}'"> <i class="fas fa-arrow-left mt-1"></i>  Retour</button>
                                    </div> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive" style=" overflow-y: auto; height:400px;">
                                        <table id="tableVente" class="table table-bordered table-striped table-hover align-middle">
                                            <thead class="table-primary text-center">
                                                <tr style="white-space: nowrap;">
                                                    <th>Date</th>
                                                    <th>Désignation</th>
                                                    <th>IMEI</th>
                                                    <th>Couleur</th>
                                                    <th>Capacité</th>
                                                    
                                                    <th>État</th>
                                                    <th>Client</th>
                                                    <th>Contact</th>
                                                    <th>Prix Boutique</th>
                                                    <th>Prix Vendu</th>
                                                    <th>Espèces</th>
                                                    <th>MoMo</th>
                                                    <th>Reste</th>
                                                    {{--  <th>Auteur(s)</th>  --}}
                                                    <th>Date échéance</th>
                                                    <th>Observations</th>
                                                    <th>Annuler Par</th>
                                                </tr>
                                            </thead>
                                            <tbody id="categoryTable">
    
    
                                                @if($venteArticle->isEmpty())
                                                <tr>
                                                    <td colspan="13" class="text-center text-muted">Aucune donnée disponible</td>
                                                </tr>
                                            @else
                                            @foreach($venteArticle->sortByDesc('created_at') as $vente)
                                            <tr class="text-center" style=" white-space: nowrap;">
                                                <td class="category-date">{{ \Carbon\Carbon::parse($vente->DateVente)->format('d-m-Y') }} {{ $vente->HeureVente }}</td>
                                                <td class="category-title" >{{ $vente->entreeArticle->articlee->Designation  }}</td>
                                                <td class="category-description">{{ $vente->entreeArticle->IMEI ?? "-" }}</td>
                                                <td >{{ $vente->entreeArticle->Couleur ?? "-" }}</td>
                                                <td>{{ $vente->entreeArticle->Capacite ?? "-" }}</td>
                                               
                                                <td class="category-etat" >{{ $vente->entreeArticle->Etat ?? "-" }}</td>
                                                <td class="category-capacite">{{ $vente->NomClient }}</td>
                                                <td>{{ $vente->TelClient }}</td>
                                                <td >{{ number_format($vente ->entreeArticle->PrixVente, 0, ',', ' ') }} </td>
                                                <td class="montant">{{ number_format($vente->MontantVente, 0, ',', ' ') }} </td>
                                                <td class="espece">{{ number_format($vente->Espece, 0, ',', ' ') }} </td>
                                                <td class="momo">{{ number_format($vente->MoMo, 0, ',', ' ') }} </td>
                                                <td class="reste" >{{ number_format($vente->Reste, 0, ',', ' ') }} </td>
                                                <td  >{{\Carbon\Carbon::parse($vente->DateEcheance)->format('d-m-Y')  ?? "-" }} </td>
                                                <td  >{{ $vente->Observations ?? "-" }} </td>
                                              
                                                {{--  <td>{{ $vente->usere->name }}</td>  --}}
                                                <td >
                                                    {{ $vente->user->name }}
                                                  
    
                                                    {{--  <button onclick="imprimerTable()" class="btn btn-warning">
                                                    <i class="bi bi-printer"></i>
                                                 </button>  --}}
                                                   {{--  <button onclick="imprimerLigne(this)" class="btn btn-sm btn-warning mx-1" title="Imprimer">
                                                    <i class="bi bi-printer"></i>
                                                    </button>    --}}
                                                     
    
                                                </td>
                                            </tr>
    
    
    
    
    
    
        
    
    
    
    
                               
    
    
    
    
                                        @endforeach
    
                                            @endif
                                            </tbody>
    
                                            <tfoot class="table-light">
                                                <tr class="text-center fw-bold">
                                                    <td colspan="9">TOTAL</td>
                                                    <td id="totalMontant">0</td>
                                                    <td id="totalEspece">0</td>
                                                    <td id="totalMoMo">0</td>
                                                    <td id="totalReste">0</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="d-flex justify-content-center" >
                                            @if($venteArticle->count()> 0)
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : {{$venteArticle->count()}}</div>
    
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
@section("scripts")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{--  <script>
    $(document).ready(function() {
        console.log("Script chargé !");

        $("#imei").on("input", function() {
            console.log("IMEI saisi :", $(this).val());

            var imei = $(this).val();
            if (imei.length > 3) {
                $.ajax({
                    url: "{{ route('get.article.details') }}",
                    type: "GET",
                    data: { imei: imei },
                    success: function(response) {
                        console.log("Réponse du serveur :", response);

                        if (response.success) {
                            $("#modele").val(response.data.modele);
                            $("#couleur").val(response.data.couleur);
                            $("#capacite").val(response.data.capacite);
                            $("#etat").val(response.data.etat);
                            $("#IdEntre").val(response.data.IdEntre);
                        } else {
                            $("#modele, #couleur, #capacite, #etat").val("");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Erreur AJAX :", error);
                    }
                });
            }
        });
    });
</script>  --}}

<script>
    $(document).ready(function() {
        console.log("Script chargé !");

        $("#imei").on("input", function() {
            console.log("IMEI saisi :", $(this).val());

            var imei = $(this).val();

            // Si le champ IMEI est vide, on vide les champs correspondants
            if (imei === "" ||imei.length <= 3) {
                $("#modele, #couleur, #capacite, #etat, #IdEntre").val("");
            } else if (imei.length > 3) {
                $.ajax({
                    url: "{{ route('get.article.details') }}",
                    type: "GET",
                    data: { imei: imei },
                    success: function(response) {
                        console.log("Réponse du serveur :", response);

                        if (response.success) {
                            $("#modele").val(response.data.modele);
                            $("#couleur").val(response.data.couleur);
                            $("#capacite").val(response.data.capacite);
                            $("#etat").val(response.data.etat);
                            $("#IdEntre").val(response.data.IdEntre);
                            $("#prixvente").val(response.data.prixvente);
                        } else {
                            // Si l'IMEI ne correspond à rien, on vide les champs
                            $("#modele, #couleur, #capacite, #etat").val("");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Erreur AJAX :", error);
                    }
                });
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let modal = document.getElementById("venteModal"); // ID correct du modal
        let form, prixVente, espece, momo, reste, dateEcheance;

        // Exécuter le script quand le modal s'affiche
        modal.addEventListener("shown.bs.modal", function () {
            form = modal.querySelector("form");
            prixVente = modal.querySelector("input[name='MontantVente']");
            espece = modal.querySelector("input[name='Espece']");
            momo = modal.querySelector("input[name='MoMo']");
            reste = modal.querySelector("input[name='Reste']");
            dateEcheance = modal.querySelector("input[name='DateEcheance']");

            function calculerReste() {
                let totalVente = parseFloat(prixVente.value) || 0;
                let totalEspece = parseFloat(espece.value) || 0;
                let totalMomo = parseFloat(momo.value) || 0;
                let totalReste = totalVente - totalEspece - totalMomo;

                reste.value = totalReste.toFixed(2); // Met à jour le champ reste
            }

            // Met à jour "Reste" à chaque changement de valeur
            prixVente.addEventListener("input", calculerReste);
            espece.addEventListener("input", calculerReste);
            momo.addEventListener("input", calculerReste);

            // Vérifie la validité avant la soumission
            form.addEventListener("submit", function (event) {
                if (parseFloat(reste.value) > 0 && !dateEcheance.value) {
                    event.preventDefault(); // Bloque la soumission
                    alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                    dateEcheance.focus();
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let modal = document.getElementById("venteAccessoireModal");
        let form, prixVente, espece, momo, reste, dateEcheance;

        // Exécuter le script quand le modal s'affiche
        modal.addEventListener("shown.bs.modal", function () {
            form = modal.querySelector("form");
            prixVente = modal.querySelector("input[name='MontantVente']");
            espece = modal.querySelector("input[name='Espece']");
            momo = modal.querySelector("input[name='MoMo']");
            reste = modal.querySelector("input[name='Reste']");
            dateEcheance = modal.querySelector("input[name='DateEcheance']");

            function calculerReste() {
                // Récupère les valeurs en tant que nombres flottants
                let totalVente = parseFloat(prixVente.value) || 0;
                let totalEspece = parseFloat(espece.value) || 0;
                let totalMomo = parseFloat(momo.value) || 0;

                // Calcul du reste
                let totalReste = totalVente - totalEspece - totalMomo;

                // Mettre à jour le champ "reste"
                reste.value = totalReste.toFixed(2);
            }

            // Met à jour le "reste" à chaque changement de valeur
            prixVente.addEventListener("input", calculerReste);
            espece.addEventListener("input", calculerReste);
            momo.addEventListener("input", calculerReste);

            // Vérifie la validité avant la soumission
            form.addEventListener("submit", function (event) {
                if (parseFloat(reste.value) > 0 && !dateEcheance.value) {
                    event.preventDefault(); // Bloque la soumission
                    alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                    dateEcheance.focus();
                }
            });
        });
    });

</script>
<script>
    function imprimerTable() {
        var contenu = document.getElementById('tableVente').outerHTML;
        var fenetreImpression = window.open('', '', 'height=600,width=800');

        fenetreImpression.document.write('<html><head><title>Impression</title>');
        fenetreImpression.document.write('<style>');
        fenetreImpression.document.write('table { width: 100%; border-collapse: collapse; }');
        fenetreImpression.document.write('th, td { border: 1px solid black; padding: 8px; text-align: center; }');
        fenetreImpression.document.write('</style>');
        fenetreImpression.document.write('</head><body>');
        fenetreImpression.document.write('<h2 style="text-align:center;">Liste des Ventes</h2>');
        fenetreImpression.document.write(contenu);
        fenetreImpression.document.write('</body></html>');

        fenetreImpression.document.close();
        fenetreImpression.print();
    }
</script>
<script>
    function imprimerLigne(button) {
        var ligne = button.closest('tr'); // Trouver la ligne parente du bouton cliqué
        var contenu = ligne.outerHTML; // Récupérer uniquement la ligne

        var fenetreImpression = window.open('', '', 'height=600,width=800');
        fenetreImpression.document.write('<html><head><title>Impression</title>');
        fenetreImpression.document.write('<style>');
        fenetreImpression.document.write('table { width: 100%; border-collapse: collapse; }');
        fenetreImpression.document.write('th, td { border: 1px solid black; padding: 8px; text-align: center; }');
        fenetreImpression.document.write('</style>');
        fenetreImpression.document.write('</head><body>');
        fenetreImpression.document.write('<h2 style="text-align:center;">Détails de la Vente</h2>');
        fenetreImpression.document.write('<table>' + contenu + '</table>');
        fenetreImpression.document.write('</body></html>');

        fenetreImpression.document.close();
        fenetreImpression.print();
    }
</script>
<script>
    function imprimerLigneAvecEntete(button) {
        var ligne = button.closest('tr'); // Trouver la ligne parente du bouton cliqué
        var entete = document.querySelector('thead').outerHTML; // Récupérer l'en-tête du tableau
        var contenu = ligne.outerHTML; // Récupérer uniquement la ligne sélectionnée

        var fenetreImpression = window.open('', '', 'height=600,width=800');
        fenetreImpression.document.write('<html><head><title>Impression</title>');
        fenetreImpression.document.write('<style>');
        fenetreImpression.document.write('table { width: 100%; border-collapse: collapse; margin: auto; }');
        fenetreImpression.document.write('th, td { border: 1px solid black; padding: 8px; text-align: center; }');
        fenetreImpression.document.write('</style>');
        fenetreImpression.document.write('</head><body>');
        fenetreImpression.document.write('<h2 style="text-align:center;">Détails de la Vente</h2>');
        fenetreImpression.document.write('<table>' + entete + contenu + '</table>'); // Afficher l'en-tête + ligne
        fenetreImpression.document.write('</body></html>');

        fenetreImpression.document.close();
        fenetreImpression.print();
    }
</script>

<script>
    function calculerTotaux() {
        let totalMontant = 0, totalEspece = 0, totalMoMo = 0, totalReste = 0;
    
        document.querySelectorAll('.montant').forEach(cell => {
            totalMontant += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });
        document.querySelectorAll('.espece').forEach(cell => {
            totalEspece += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });
        document.querySelectorAll('.momo').forEach(cell => {
            totalMoMo += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });
        document.querySelectorAll('.reste').forEach(cell => {
            totalReste += parseFloat(cell.innerText.replace(/\s/g, '')) || 0;
        });
    
        document.getElementById('totalMontant').innerText = totalMontant.toLocaleString();
        document.getElementById('totalEspece').innerText = totalEspece.toLocaleString();
        document.getElementById('totalMoMo').innerText = totalMoMo.toLocaleString();
        document.getElementById('totalReste').innerText = totalReste.toLocaleString();
    }
    
    window.onload = calculerTotaux;
    
</script>

{{--  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Sélection des champs
        let prixVente = document.getElementById("prixvente");
        let espece = document.querySelector("input[name='Espece']");
        let momo = document.querySelector("input[name='MoMo']");
        let reste = document.querySelector("input[name='Reste']");

        function calculerReste() {
            let prix = parseFloat(prixVente.value) || 0;
            let especePaye = parseFloat(espece.value) || 0;
            let momoPaye = parseFloat(momo.value) || 0;

            let resteAPayer = prix - especePaye - momoPaye;

            // Empêche un reste négatif
            reste.value = resteAPayer >= 0 ? resteAPayer : 0;
        }

        // Écouteurs d'événements pour recalculer en temps réel
        prixVente.addEventListener("input", calculerReste);
        espece.addEventListener("input", calculerReste);
        momo.addEventListener("input", calculerReste);
    });
</script>  --}}
{{--  <script>
    document.addEventListener("DOMContentLoaded", function () {
        let reste = document.querySelector("input[name='Reste']");
        let dateEcheance = document.querySelector("input[name='DateEcheance']");

        function verifierObligationDate() {
            if (parseFloat(reste.value) > 0) {
                dateEcheance.setAttribute("required", "required");
            } else {
                dateEcheance.removeAttribute("required");
            }
        }

        // Vérifier au chargement si un reste est déjà présent
        verifierObligationDate();

        // Écouter les changements sur le champ RESTE
        reste.addEventListener("input", verifierObligationDate);
    });
</script>  --}}
{{--  <script>
    document.addEventListener("DOMContentLoaded", function () {
        let form = document.querySelector("form"); // Sélectionne ton formulaire
        let reste = document.querySelector("input[name='Reste']");
        let dateEcheance = document.querySelector("input[name='DateEcheance']");

        form.addEventListener("submit", function (event) {
            if (parseFloat(reste.value) > 0 && !dateEcheance.value) {
                event.preventDefault(); // Empêche l'envoi du formulaire
                alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                dateEcheance.focus();
            }
        });
    });
</script>  --}}
