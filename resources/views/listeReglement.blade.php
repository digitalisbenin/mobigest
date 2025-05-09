
@extends('layouts.admin')
@section('title', 'Liste Reglement Vente')
@section('content')
<!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h5 class=" mb-0 text-gray-800">LISTE DES REGLEMENT CREANCE</h5>

                            <div class="d-flex align-items-center  "> <!-- Flexbox pour aligner les éléments -->
                                <form method="GET" action="{{url('liste-reglement-ventes')}}" class="d-flex flex-wrap ">
                                    @csrf
                                    <!-- Champ pour la date de début -->
                                    <div class="mb-1 me-1 d-flex ">
                                        <label for="start_date" class="form-label ml-3 mt-2">DEBUT</label>
                                        <input type="date" class="form-control ml-2" id="start_date" name="start_date" value="{{ request('start_date') }}">
                                    </div>

                                    <!-- Champ pour la date de fin -->
                                    <div class="mb-1 me-3 d-flex ">
                                        <label for="end_date" class="form-label ml-3 mt-2">FIN</label>
                                        <input type="date" class="form-control ml-2 me-3" id="end_date" name="end_date" value="{{ request('end_date') }}">
                                    </div>


                                    <div class="mb-1 me-3 col ">
                                         <button type="submit" class="btn btn-primary  me-2">Filtrer</button>
                                    </div>

                                    <!-- Bouton de soumission -->

                                </form>
                                {{--  <button type="button"  class="btn btn-secondary me-5 " onclick="window.location='{{ url('liste-reglement-ventes') }}'">Réinitialiser</button>  --}}

                                <div class="col align-self-start">
                                    <a href="{{url('reglement-ventes')}}" class="btn  btn-primary mx-2" >
                                        Nouveau
    
                                      </a>
                                </div>
                            </div>
                            

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
                            {{--  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reglementModal">
                                Nouveau Modal Règlement
                            </button>  --}}



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


                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive" style=" overflow-y: auto; height:450px">
                                        <table id="tableVente" class="table table-bordered table-striped table-hover align-middle">
                                            <thead class="table-primary text-center">
                                                <tr style="white-space: nowrap;">
                                                    <th>Date Règlement</th>
                                                    <th>Désignation</th>
                                                    {{--  <th>IMEI</th>
                                                    <th>Couleur</th>  --}}
                                                    {{--  <th>Capacité</th>  --}}

                                                    {{--  <th>État</th>  --}}
                                                    <th>Client</th>
                                                    <th>Contact</th>
                                                    {{--  <th>Prix Boutique</th>  --}}
                                                    <th>Dette Antérieure</th>
                                                    <th>Espèces</th>
                                                    <th>MoMo</th>
                                                    <th>Dette Actuelle</th>
                                                    {{--  <th>Auteur(s)</th>  --}}
                                                    <th>Date échéance</th>
                                                    {{--  <th>Observations</th>  --}}
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                @if($reglementVente->isEmpty())
                                                <tr>
                                                    <td colspan="10" class="text-center text-muted">Aucune donnée disponible</td>
                                                </tr>
                                            @else
                                            @foreach($reglementVente->sortByDesc('created_at') as $vente)
                                            <tr class="text-center" style=" white-space: nowrap;">
                                                <td>{{ \Carbon\Carbon::parse($vente->DateRegl)->format('d-m-Y') }} {{ $vente->HeureEnreg }}</td>
                                                <td>{{ $vente->reglementVente->entreeArticle->articlee->Designation  }}</td>
                                                {{--  <td>{{ $vente->entreeArticle->IMEI ?? "-" }}</td>
                                                <td>{{ $vente->entreeArticle->Couleur ?? "-" }}</td>  --}}
                                                {{--  <td>{{ $vente->entreeArticle->Capacite ?? "-" }}</td>  --}}

                                                {{--  <td>{{ $vente->entreeArticle->Etat ?? "-" }}</td>  --}}
                                                <td>{{ $vente->reglementVente->NomClient }}</td>
                                                <td>{{ $vente->reglementVente->TelClient }}</td>
                                                {{--  <td >{{ number_format($vente ->entreeArticle->PrixVente, 0, ',', ' ') }} </td>  --}}
                                                <td class="montant">{{ number_format($vente->DetteAnt, 0, ',', ' ') }} </td>
                                                <td class="espece">{{ number_format($vente->MontantReglEsp, 0, ',', ' ') }} </td>
                                                <td class="momo">{{ number_format($vente->MontantReglMoMo, 0, ',', ' ') }} </td>
                                                <td class="reste" >{{ number_format($vente->DetteAct, 0, ',', ' ') }} </td>
                                                <td  >{{\Carbon\Carbon::parse($vente->reglementVente->DateEcheance)->format('d-m-Y')  ?? "-" }} </td>
                                                {{--  <td  >{{ $vente->Observations ?? "-" }} </td>  --}}

                                                {{--  <td>{{ $vente->usere->name }}</td>  --}}
                                                <td class="d-flex">

                                                    {{--  <a href="#" class="btn btn-sm btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#annulerVenteModal{{ $vente->IDVente }}" data-bs-placement="top" title="Annuler la vente">
                                                        <i class="bi bi-cash"></i>
                                                          <i class="bi bi-wallet2"></i>
                                                    </a>  --}}


                                                    {{--  <button onclick="imprimerTable()" class="btn btn-warning">
                                                    <i class="bi bi-printer"></i>
                                                 </button>  --}}
                                                   {{--  <button onclick="imprimerLigne(this)" class="btn btn-sm btn-warning mx-1" title="Imprimer">
                                                    <i class="bi bi-printer"></i>
                                                    </button>    --}}


                                                </td>
                                            </tr>




                        <div class="modal fade" id="annulerVenteModal{{ $vente->IDVente }}" tabindex="-1" aria-labelledby="annulerVenteModalLabel{{ $vente->IDVente }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="annulerVenteModalLabel{{ $vente->IDVente }}">REGLER UN CREANCE </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('create-new-reglement-ventes' ) }}" method="POST">
                                            @csrf

                                        <div class="row">
                                            <input type="hidden" class="form-control" name="IDVente" value="{{ $vente->IDVente  }}">
                                            <div class=" col-md-6 mb-1">
                                                <label class="form-label">DATE REGLEMENT</label>
                                                <input type="date" class="form-control" name="DateRegl" required>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label class="form-label">DETTE ANTERIEUR</label>
                                                <input type="number" id="prixvente" class="form-control text-end" name="DetteAnt"  value="{{ $vente->Reste  }}" >
                                            </div>
                                            <div class="col-md-6  mb-1">
                                                <label class="form-label">ESPÈCE PERÇU</label>
                                                <input type="number" class="form-control text-end"  name="MontantReglEsp" value="0" >
                                            </div>
                                            <div class=" col-md-6 mb-1">
                                                <label class="form-label">MoMo REÇU</label>
                                                <input type="number" class="form-control text-end" name="MontantReglMoMo" value="0" >
                                            </div>
                                            <div class=" col-md-6 mb-1">
                                                <label class="form-label">RESTE</label>
                                                <input type="number" class="form-control text-end" name="DetteAct" value="0" >
                                            </div>
                                            <div class=" col-md-6 mb-1">
                                                <label class="form-label">ÉCHÉANCE</label>
                                                <input type="date" class="form-control" name="DateEcheance"value="">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Observations</label>
                                            <textarea class="form-control" rows="3" name="Observations" id="CauseAnnulat" ></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                         <button type="submit" class="btn btn-success">Valider</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>













                                        @endforeach

                                            @endif
                                            </tbody>

                                            <tfoot class="table-light">
                                                <tr class="text-center fw-bold">
                                                    <td colspan="4">TOTAL</td>
                                                    <td id="totalMontant">0</td>
                                                    <td id="totalEspece">0</td>
                                                    <td id="totalMoMo">0</td>
                                                    <td id="totalReste">0</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div class="d-flex justify-content-center" >
                                            @if($reglementVente->count()> 0)
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : {{$reglementVente->count()}}</div>

                                             @else
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800 text-end">NOMBRES DE LIGNES : 0</div>

                                             @endif
                                        </div>
                                    </div>







                                </div>
                            </div>
                        </div>


                    </div>


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
        // Sélection de tous les modals d'annulation de vente
        document.querySelectorAll("[id^='annulerVenteModal']").forEach(modal => {
            modal.addEventListener("shown.bs.modal", function () {
                let form = modal.querySelector("form");
                let detteAnterieur = modal.querySelector("input[name='DetteAnt']");
                let especePerçu = modal.querySelector("input[name='MontantReglEsp']");
                let momoReçu = modal.querySelector("input[name='MontantReglMoMo']");
                let detteActuelle = modal.querySelector("input[name='DetteAct']");
                let dateEcheance = modal.querySelector("input[name='DateEcheance']");

                function calculerReste() {
                    let totalDette = parseFloat(detteAnterieur.value) || 0;
                    let totalEspece = parseFloat(especePerçu.value) || 0;
                    let totalMomo = parseFloat(momoReçu.value) || 0;
                    let totalReste = totalDette - totalEspece - totalMomo;

                    // Mettre à jour le champ "reste"
                    detteActuelle.value = totalReste.toFixed(2);
                }

                // Met à jour le "reste" à chaque changement de valeur
                especePerçu.addEventListener("input", calculerReste);
                momoReçu.addEventListener("input", calculerReste);

                // Vérifie la validité avant la soumission
                form.addEventListener("submit", function (event) {
                    if (parseFloat(detteActuelle.value) > 0 && !dateEcheance.value) {
                        event.preventDefault(); // Bloque la soumission
                        alert("Veuillez renseigner la date d'échéance si un reste est présent.");
                        dateEcheance.focus();
                    }
                });
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
