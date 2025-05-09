<?php

namespace App\Imports;

use App\Models\VenteArticle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VenteArticleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new VenteArticle([
        'IDVente'       => $row['idvente'],
        'NumVente'       => $row['numvente'],
        'quantite'       => $row['quantite'],
        'DateVente'      => $row['datevente'],
        'HeureVente'     => $row['heurevente'],
        'EnregistrerPar' => $row['enregistrerpar'],
        'MontantVente'   => $row['montantvente'],
        'Observations'   => $row['observations'],
        'IdEntree'       => $row['identree'],
        'Statut'         => $row['statut'],
        'Espece'         => $row['espece'],
        'MoMo'           => $row['momo'],
        'AutreM'         => $row['autrem'],
        'Reste'          => $row['reste'],
        'DateEcheance'   => $row['dateecheance'],
        'DateModif'      => $row['datemodif'],
        'HeureModif'     => $row['heuremodif'],
        'ModifPar'       => $row['modifpar'],
        'DateAnnul'      => $row['dateannul'],
        'HeureAnnul'     => $row['heureannul'],
        'AnnulerPar'     => $row['annulerpar'],
        'NomClient'      => $row['nomclient'],
        'TelClient'      => $row['telclient'],
        'CauseAnnulat'   => $row['causeannulat'],
        'MargeBenefic'   => $row['margebenefic'],
        'created_at'     => $row['created_at'],
        'updated_at'     => $row['updated_at'],
        ]);
    }
}
