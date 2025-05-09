<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Annuler Vente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
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
            align-items: center;
            gap: 10px;
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
        AVAILABLE GADGET STORE / ENREGISTREMENT D'UN ARTICLE
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
                    <a href="#" class="text-decoration-none text-white">
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
                    <a href="#" class="text-decoration-none text-white">
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
        <div class="date-filters col-3">
            <div class="mb-3 ms-5">
                <label for="dateDebut" class="form-label text-white">Date Début</label>
                <input type="date" id="dateDebut" class="form-control w-auto">
            </div>
            <div class="mb-3">
                <label for="dateFin" class="form-label text-white">Date Fin</label>
                <input type="date" id="dateFin" class="form-control w-auto">
            </div>
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
<div class="mt-3 d-flex justify-content-end mx-2">
    <div>
        <label for="client" class="form-label">Nom du Client</label>
        <input type="text" id="client" class="form-control  d-inline-block">
    </div>
    <div class="ms-3">
        <label for="imei" class="form-label">IMEI</label>
        <input type="text" id="imei" class="form-control  d-inline-block">
    </div>
</div>


    <div class="table-responsive mt-3 mx-2">
        <p class="fw-bold">
           
            VENTE ENREGISTREES AU COURS DE LA JOURNEE
        </p>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Désignation</th>
                    <th>Couleur</th>
                    <th>Capacité</th>
                    <th>IMEI</th>
                    <th>État</th>
                    <th>Client</th>
                    <th>Contact</th>
                    <th>Montant</th>
                    <th>Espèce</th>
                    <th>MoMo</th>
                    <th>Reste</th>
                    <th>Observations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>
            </tbody>
        </table>
    </div>

    {{-- <div class="footer">
        <span class="fw-bold">Montant Total Vendu : </span> <span class="text-warning">0</span> FCFA
        <span class="float-end"> <i class="far fa-clock"></i> 11:36:27</span>
    </div> --}}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
