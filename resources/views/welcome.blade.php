



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SGM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <style>
        .navbar {
            background-color: #0275d8;
        }
        .navbar-brand {
            color: white;
        }
        .header {
            background-color: #028484;
            color: white;
            padding: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }
        .header img {
            height: 40px;
            margin-right: 10px;
        }
        .top-bar {
            background-color: #730000;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }
        .top-bar div {
            text-align: center;
            color: white;
            font-size: 14px;
            flex: 1;
            min-width: 120px;
        }
        .top-bar i {
            font-size: 30px;
            display: block;
            margin-bottom: 5px;
        }
        .user-info {
            text-align: right;
            padding: 10px;
            background-color: #028484;
            color: white;
        }

        .modal-content {
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        .form-control {
            border-radius: 5px;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        body {
            background-color: #f8f9fa;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            background-color: #0174be;
            color: white;
            padding: 5px 15px;
            font-size: 14px;
            font-weight: bold;
        }
        .navbar {
            background-color: #0275d8;
        }
        .navbar-brand {
            color: white;
        }
        .header {
            background-color: #028484;
            color: white;
            padding: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }
        .header img {
            height: 40px;
            margin-right: 10px;
        }
        .top-bar {
            background-color: #730000;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }
        .top-bar div {
            text-align: center;
            color: white;
            font-size: 14px;
            flex: 1;
            min-width: 120px;
        }
        .top-bar i {
            font-size: 30px;
            display: block;
            margin-bottom: 5px;
        }
        .user-info {
            text-align: right;
            padding: 10px;
            background-color: #028484;
            color: white;
        }
        .toolbar {
            background-color: #a90a0a;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            flex-wrap: nowrap;
            gap: 10px;
        }
        .toolbar .btn {
            color: white;
            font-weight: bold;
            white-space: nowrap;
        }
        .date-filters {
            background-color: #0a088e;
            display: flex;
            flex-direction: column; /* Aligne les éléments en colonne */
            align-items: center;
            padding: 15px; /* Ajoute un peu d'espace autour */
            gap: 10px;
            border-radius: 8px; /* Optionnel, pour un effet plus doux */
        }
        .date-filters .form-control {
            width: 100%; /* Assure que les champs prennent toute la largeur */
        }
        .date-filters button {
            width: 100%; /* Le bouton prend toute la largeur */
            margin-top: 10px; /* Ajoute un espace entre les champs et le bouton */
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 10px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="logo.png" alt="Logo" style="margin-left: 10px;">
        AVAILABLE GADGET STORE / ENREGISTREMENT D'ARTICLE
    </div>
    <div class="user-info">
        Utilisateur : SUPERVISEUR<br>
        Connecté(e) : 11/02/2025 à 08:24:05
    </div>
    <div class="container-fluid p-0">
        <div class="d-flex">
            <!-- Div 1 : occupe 2/3 de l'espace -->
            <div class="toolbar col-9">
                <div class="d-flex flex-nowrap gap-4 justify-content-center">
                    <div class="col text-center ms-5">
                        <a href="vente" class="text-decoration-none text-white">
                            <i class="bi bi-cart-fill icon-size"></i><br>
                            VENTE <br>PORTABLES
                        </a>
                    </div>

                    <div class="col text-center ms-5">
                        <a href="#" class="text-decoration-none text-white">
                            <i class="bi bi-cash-stack icon-size"></i><br>
                            RÈGLEMENT<br> DE CRÉANCE
                        </a>
                    </div>
                    <div class="col text-center ms-5">
                        <a href="#" class="text-decoration-none text-white">
                            <i class="bi bi-file-earmark-x-fill icon-size"></i><br>
                            ANNULER <br>UN ARTICLE VENDU
                        </a>
                    </div>
                    <div class="col text-center ms-5">
                        <a href="depense" class="text-decoration-none text-white">
                            <i class="bi bi-currency-euro icon-size"></i><br>
                            ENREGISTRER<br> UNE DÉPENSE
                        </a>
                    </div>
                    <div class="col text-center ms-5">
                        <a href="#" class="text-decoration-none text-white">
                            <i class="bi bi-box-arrow-in-down icon-size"></i><br>
                            ENTRÉE<br> EN STOCK
                        </a>
                    </div>
                    <div class="col text-center ms-5">
                        <a href="#" class="text-decoration-none text-white">
                            <i class="bi bi-arrow-return-left icon-size"></i><br>
                            RETOUR<br> AU FOURNISSEUR
                        </a>
                    </div>
                </div>
            </div>

            <!-- Div 2 : occupe 1/3 de l'espace -->
            <div class="date-filters col-lg-3 col-md-4 col-12">
                <div class="w-100">
                    <h6 class="text-white">Famille
                    </h6>
        <select class="form-select mb-2">
            <option selected>Tous les articles</option>
            <option value="1">Samsung</option>
            <option value="2">AirPods</option>
        </select>
                </div>
                <div class="w-100">
                    <input type="text" class="form-control" placeholder="Saisir la désignation du téléphone">

                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>
            </div>

        </div>

        <style>
            .icon-size {
                font-size: 2.5rem; /* Vous pouvez ajuster cette valeur pour changer la taille des icônes */
            }
            .text-center {
                text-align: center;
            }
            .date-filters {
                margin-top: 0; /* Enlever tout espace entre les deux sections */
            }
        </style>

    </div>

    <div class="">
        {{--  <div class="row text-center">
            <div class="col"><a href="vente-portables.html" class="text-decoration-none text-white"><i class="bi bi-cart-fill"></i> VENTE PORTABLES</a></div>
            <div class="col"><a href="vente" class="text-decoration-none text-white"><i class="bi bi-headphones"></i> VENTE ACCESSOIRES</a></div>
            <div class="col"><a href="reglement-creance.html" class="text-decoration-none text-white"><i class="bi bi-cash-stack"></i> RÈGLEMENT DE CRÉANCE</a></div>
            <div class="col"><a href="annuler-article.html" class="text-decoration-none text-white"><i class="bi bi-file-earmark-x-fill"></i> ANNULER UN ARTICLE VENDU</a></div>
            <div class="col"><a href="depense" class="text-decoration-none text-white"><i class="bi bi-currency-euro"></i> ENREGISTRER UNE DÉPENSE</a></div>
            <div class="col"><a href="entree-stock.html" class="text-decoration-none text-white"><i class="bi bi-box-arrow-in-down"></i> ENTRÉE EN STOCK</a></div>
            <div class="col"><a href="retour-fournisseur.html" class="text-decoration-none text-white"><i class="bi bi-arrow-return-left"></i> RETOUR AU FOURNISSEUR</a></div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col-md-4">
                <select class="form-select">
                    <option selected>Tous les articles</option>
                    <option value="1">Samsung</option>
                    <option value="2">AirPods</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Saisir la désignation du téléphone">
            </div>
            <div class="col-md-4 text-end">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#venteModal">
            Nouveau
             </button>


            </div>
        </div>  --}}

        <table class="table table-bordered text-center mt-3">
            <thead class="table-primary">
                <tr>
                    <th>DESIGNATION</th>
                    <th>STOCK</th>
                    <th>FAMILLE</th>

                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A10S</td>
                    <td>0</td>
                    <td>SAMSUNG</td>

<td class="action-icons">
    <a href="#" class="btn btn-sm btn-primary mx-1"><i class="bi bi-pencil"></i></a>
    <a href="#" class="btn btn-sm btn-danger mx-1"><i class="bi bi-trash"></i></a>
    <a href="#" class="btn btn-sm btn-success mx-1"><i class="bi bi-eye"></i></a>
    <a href="#" class="btn btn-sm btn-warning mx-1"><i class="bi bi-plus-circle"></i></a>
</td>

                </tr>
            </tbody>
        </table>
    </div>
        <!-- Modal d'enregistrement -->
    <div class="modal fade" id="modalEnregistrement" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">FICHE D'ENREGISTREMENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <label for="famille" class="form-label">Famille</label>
                        {{--  <div class="mb-3 d-flex">
                            <label for="famille" class="form-label">Famille</label>
                            <select class="form-select" id="famille">
                                <option selected>IPHONE</option>
                            </select>
                             <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn"> <i class="bi bi-plus-circle text-warning"></i></button>
                        </div>  --}}

<div class="mb-3 d-flex">
    <select class="form-select" id="famille">
        {{--  <option selected disabled>Choisir une famille</option>  --}}
        @foreach($familles as $famille)
            <option value="{{ $famille->id }}">{{ $famille->LibFamille }}</option>
        @endforeach
    </select>
    <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn">
        <i class="bi bi-plus-circle text-white"></i>
    </button>
</div>


                        <div class="mb-3">
                            <label for="modele" class="form-label">Modèle de Téléphone</label>
                            <input type="text" class="form-control" id="modele">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Prix d'achat</label>
                                <input type="number" class="form-control text-end " value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Stock Disponible</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label class="form-label">Prix de scellé</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Prix de vente</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Prix de troc</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </div>
      <div class="container mt-5">


        <div class="modal fade" id="venteModal" tabindex="-1" aria-labelledby="venteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="venteModalLabel">FICHE DE VENTE...</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-8 equal-height">
                                    <div class="card p-3 mb-3 h-90">
                                        <h5 class="text-primary">INFORMATIONS CONCERNANT LE TELEPHONE</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">IMEI</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">MODÈLE DE TÉLÉPHONE</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">COULEUR</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">CAPACITÉ</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">ÉTAT</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>

                                        <h5 class="text-primary">INFORMATIONS CONCERNANT LE CLIENT</h5>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">NOM DU CLIENT</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">CONTACT(S)</label>
                                                <input type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">OBSERVATIONS</label>
                                            <textarea class="form-control" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 equal-height">
                                    <div class="card p-3 h-90">
                                        <h5 class="text-primary">DÉTAILS DE VENTE</h5>
                                        <div class="mb-3">
                                            <label class="form-label">DATE VENTE</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">PRIX VENTE</label>
                                            <input type="number" class="form-control text-end" value="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ESPÈCE PERÇU</label>
                                            <input type="number" class="form-control text-end" value="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">MoMo REÇU</label>
                                            <input type="number" class="form-control text-end" value="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">RESTE</label>
                                            <input type="number" class="form-control text-end" value="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ÉCHÉANCE</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 mt-3">VALIDER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal d'enregistrement -->
    <div class="modal fade" id="modalEnregistrement" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">FICHE D'ENREGISTREMENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                         <label for="famille" class="form-label">Famille</label>
                        <div class="mb-3 d-flex">

                            <select class="form-select" id="famille">
                                <option selected>IPHONE</option>
                            </select>
                             <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn"> <i class="bi bi-plus-circle text-white"></i></button>
                        </div>
                        <div class="mb-3">
                            <label for="modele" class="form-label">Modèle de Téléphone</label>
                            <input type="text" class="form-control" id="modele">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Prix d'achat</label>
                                <input type="number" class="form-control text-end " value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Stock Disponible</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label class="form-label">Prix de scellé</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Prix de vente</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Prix de troc</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{--  <script>
        document.getElementById('ajouterFamilleBtn').addEventListener('click', function() {
            // Code pour ajouter une famille sans fermer le modal
            let familleInput = document.getElementById('famille');
            let nouvelleFamille = prompt('Veuillez entrer une nouvelle famille:');
            if (nouvelleFamille) {
                let option = document.createElement('option');
                option.textContent = nouvelleFamille;
                familleInput.appendChild(option);
                familleInput.value = nouvelleFamille; // Sélectionner la nouvelle famille
            }
        });
    </script>  --}}

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
</script>

</body>
</html>

{{--  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Stocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <style>
        .navbar {
            background-color: #0275d8;
        }
        .navbar-brand {
            color: white;
        }
        .header {
            background-color: #028484;
            color: white;
            padding: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }
        .header img {
            height: 40px;
            margin-right: 10px;
        }
        .top-bar {
            background-color: #730000;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
        }
        .top-bar div {
            text-align: center;
            color: white;
            font-size: 14px;
            flex: 1;
            min-width: 120px;
        }
        .top-bar i {
            font-size: 20px;
            display: block;
            margin-bottom: 5px;
        }
        .user-info {
            text-align: right;
            padding: 10px;
            background-color: #028484;
            color: white;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="logo.png" alt="Logo" style="margin-left: 10px;">
        AVAILABLE GADGET STORE / ENREGISTREMENT D'UN ARTICLE
    </div>
    <div class="user-info">
        Utilisateur : SUPERVISEUR<br>
        Connecté(e) : 11/02/2025 à 08:24:05
    </div>

    <div class="top-bar container-fluid">
        <div class="row text-center">


    <div class="col"><a href="vente-portables.html" class="text-decoration-none text-white"><i class="bi bi-cart-fill"></i> VENTE PORTABLES</a></div>
    <div class="col"><a href="vente" class="text-decoration-none text-white"><i class="bi bi-headphones"></i> VENTE ACCESSOIRES</a></div>
    <div class="col"><a href="reglement-creance.html" class="text-decoration-none text-white"><i class="bi bi-cash-stack"></i> RÈGLEMENT DE CRÉANCE</a></div>
    <div class="col"><a href="annuler-article.html" class="text-decoration-none text-white"><i class="bi bi-file-earmark-x-fill"></i> ANNULER UN ARTICLE VENDU</a></div>
    <div class="col"><a href="depense" class="text-decoration-none text-white"><i class="bi bi-currency-euro"></i> ENREGISTRER UNE DÉPENSE</a></div>
    <div class="col"><a href="entree-stock.html" class="text-decoration-none text-white"><i class="bi bi-box-arrow-in-down"></i> ENTRÉE EN STOCK</a></div>
    <div class="col"><a href="retour-fournisseur.html" class="text-decoration-none text-white"><i class="bi bi-arrow-return-left"></i> RETOUR AU FOURNISSEUR</a></div>



            <div class="col-lg-3 col-md-4 col-12" style=" background-color: #028484;">
                <h6>Famille
                </h6>
    <select class="form-select mb-2">
        <option selected>Tous les articles</option>
        <option value="1">Samsung</option>
        <option value="2">AirPods</option>
    </select>

    <div class="d-flex gap-2">
        <input type="text" class="form-control" placeholder="Saisir la désignation du téléphone">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEnregistrement">Nouveau</button>
    </div>
</div>


        </div>
    </div>

    <div class="container mt-3">



        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>DESIGNATION</th>
                    <th>STOCK</th>
                    <th>FAMILLE</th>

                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A10S</td>
                    <td>0</td>
                    <td>SAMSUNG</td>

             <td class="action-icons">
    <a href="#" class="btn btn-sm btn-primary mx-1"><i class="bi bi-pencil"></i></a>
    <a href="#" class="btn btn-sm btn-danger mx-1"><i class="bi bi-trash"></i></a>
    <a href="#" class="btn btn-sm btn-success mx-1"><i class="bi bi-eye"></i></a>
    <a href="#" class="btn btn-sm btn-warning mx-1"><i class="bi bi-plus-circle"></i></a>
</td>


                </tr>
            </tbody>
        </table>
    </div>
        <!-- Modal d'enregistrement -->
    <div class="modal fade" id="modalEnregistrement" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">FICHE D'ENREGISTREMENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                         <label for="famille" class="form-label">Famille</label>
                        <div class="mb-3 d-flex">

                            <select class="form-select" id="famille">
                                <option selected>IPHONE</option>
                            </select>
                             <button type="button" class="btn btn-primary ms-2" id="ajouterFamilleBtn"> <i class="bi bi-plus-circle text-white"></i></button>
                        </div>
                        <div class="mb-3">
                            <label for="modele" class="form-label">Modèle de Téléphone</label>
                            <input type="text" class="form-control" id="modele">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Prix d'achat</label>
                                <input type="number" class="form-control text-end " value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Stock Disponible</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label class="form-label">Prix de scellé</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Prix de vente</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                            <div class="col">
                                <label class="form-label">Prix de troc</label>
                                <input type="number" class="form-control text-end" value="0">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('ajouterFamilleBtn').addEventListener('click', function() {

            let familleInput = document.getElementById('famille');
            let nouvelleFamille = prompt('Veuillez entrer une nouvelle famille:');
            if (nouvelleFamille) {
                let option = document.createElement('option');
                option.textContent = nouvelleFamille;
                familleInput.appendChild(option);
                familleInput.value = nouvelleFamille;
            }
        });
    </script>
</body>
</html>
  --}}
