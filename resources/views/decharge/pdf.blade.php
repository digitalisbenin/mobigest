
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Décharge de Vente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 90%; margin: auto; padding: 10px; border: 1px solid #000; }
        .header, .footer { text-align: center; position: relative; }
        .logo-left, .logo-right { position: absolute; top: 0; width: 50px; height: 50px; }
        .logo-left { left: 0; }
        .logo-right { right: 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table, .table th, .table td { border: 1px solid black; padding: 5px; text-align: left; }
        .content, .table, .footer { page-break-inside: avoid; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/uploads/logo/'.$societe->Logo) }}" alt="Logo" class="logo-left">
            <h2>{{$societe->NomSociete}} </h2>
            <img src="{{ public_path('assets/uploads/logo/'.$societe->Logo) }}" alt="Logo" class="logo-right">
            <p>{{ isset($societe->Telephone) ? preg_replace('/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/', '(+229) $1 $2 $3 $4 $5', $societe->Telephone) : 'Non renseigné' }}
                | {{$societe->email}}</p>
            <p>IFU : {{$societe->ifu}} | RCCM : {{$societe->rccm}}</p>
        </div>
        <hr>
        <h4 style="text-align: center;">DECHARGE DE VENTE</h4>
        <h4 style="text-align: start;">Référence: C/CAISSE/0{{$vente->NumVente}}</h4>
        <div class="content">
            <p>Je soussigné(e)  Monsieur <strong>{{$societe->responsable}}</strong>, responsable de la boutique {{$societe->NomSociete}}, située à {{$societe->Adresse}}, reconnais avoir vendu à :</p>
            <p><strong>Nom du client :</strong> {{ $vente->NomClient }}</p>
            <p><strong>Contact :</strong> {{ $vente->TelClient }}</p>
            <table class="table">
                <tr><th>Modèle</th><td>{{ $vente->entreeArticle->articlee->Designation }}</td></tr>
                <tr><th>Capacité</th><td>{{ $vente->entreeArticle->Capacite ?? "-" }}</td></tr>
                <tr><th>Couleur</th><td>{{ $vente->entreeArticle->Couleur ?? "-" }}</td></tr>
                <tr><th>IMEI </th><td>{{ $vente->entreeArticle->IMEI ?? "-" }}</td></tr>

                <tr><th>État</th><td>{{ $vente->entreeArticle->Etat ?? "-" }}</td></tr>
                <tr><th>Caractéristiques</th><td>{{ $vente->Observations ?? "-" }}</td></tr>
                <tr><th>Quantité</th><td>{{ $vente->quantite ?? "-" }}</td></tr>
                <tr><th>Montant</th><td>{{ $vente->MontantVente }} FCFA</td></tr>
                
            </table>
        </div>
        <hr>
       
        <h4 style="text-align: center; color: red;"> 
            <em> <strong>A votre attention !</strong></em>
        </h4>
        

        <p><strong>Garantie :</strong> Deux (02) semaines pour les portables (neufs) et une (01) semaine pour les portables d'occasion.</p>
        <ul>
            <li>Ne pas enlever ou nettoyer le sticker collé ou tamponné (preuve de garantie).</li>
            <li>Cassure, fissure, portable éteint exclus (la garantie ne couvre pas).</li>
            <li>Pas de remboursement après vente.</li>
            <li>Garantie liée au défaut de l'écran 72 heures.</li>
            <li>La garantie ne couvre pas les courts-circuits.</li>
        </ul>

        <hr>
        <p class="text-right"><strong>Fait à Cotonou le :</strong> {{ \Carbon\Carbon::parse($vente->DateVente)->format('d-m-Y') }}</p>
        <p class="text-right"><strong>Signature :</strong> {{ $vente->usere->name }}</p>
        <div class="footer">

        </div>
    </div>
</body>
</html>



{{--  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Décharge de Vente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 800px; margin: auto; padding: 20px; border: 1px solid #000; }
        .header, .footer { text-align: center; position: relative; }
        .logo-left, .logo-right { position: absolute; top: 0; width: 50px; height: 50px; }
        .logo-left { left: 0; }
        .logo-right { right: 0; }
        .content { margin-top: 20px; }
        .table-bordered th, .table-bordered td { border: 1px solid black !important; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo" class="logo-left">
            <h2>ETAT DECHARGE PAIEMENT MANAF</h2>
            <img src="logo.png" alt="Logo" class="logo-right">
            <p>01 96 37 48 62 | chezmanaf@gmail.com</p>
            <p>IFU : 0202011503820 | RCCM : RB/COT/20 A59092</p>
        </div>
        <hr>
        <h4 class="text-center">Décharge de Vente</h4>
        <p><strong>Garantie :</strong> Deux (02) semaines pour les portables (neufs) et une (01) semaine pour les portables d'occasion.</p>
        <ul>
            <li>Ne pas enlever ou nettoyer le sticker collé ou tamponné (preuve de garantie).</li>
            <li>Cassure, fissure, portable éteint exclus (la garantie ne couvre pas).</li>
            <li>Pas de remboursement après vente.</li>
            <li>Garantie liée au défaut de l'écran 72 heures.</li>
            <li>La garantie ne couvre pas les courts-circuits.</li>
        </ul>
        <hr>
        <div class="content">
            <p>Je soussigné(e) <strong>BABA YARA AFFO ABDOU MANAF</strong>, responsable de la boutique CHEZ MANAF, située à Cotonou, reconnais avoir vendu à :</p>
            <p><strong>Nom du client :</strong> COUSIN</p>
            <p><strong>Contact :</strong> 61413427</p>
            <table class="table table-bordered">
                <tr><th>Modèle</th><td>SAMSUNG S9 PLUS</td></tr>
                <tr><th>Capacité</th><td>64Go</td></tr>
                <tr><th>Couleur</th><td>PURPLE</td></tr>
                <tr><th>IMEI 1</th><td>355418091453303</td></tr>
                <tr><th>IMEI 2</th><td>-</td></tr>
                <tr><th>État</th><td>Scellé</td></tr>
                <tr><th>Caractéristiques</th><td>ÉCHANGE S9+ POUR PROBLÈME ÉCRAN DU 07/02/25</td></tr>
                <tr><th>Montant</th><td>80 000 Francs CFA</td></tr>
                <tr><th>Référence</th><td>C/MANAF/CAISSE/037</td></tr>
            </table>
        </div>
        <hr>
        <p><strong>Fait à Cotonou le :</strong> 08/02/2025</p>
        <p><strong>Signature :</strong> GLORIA</p>
        <div class="footer">
            <p><em>A votre attention !</em></p>
        </div>
    </div>
</body>
</html>  --}}
