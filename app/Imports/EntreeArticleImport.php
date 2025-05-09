<?php

namespace App\Imports;

use App\Models\EntreeArticle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EntreeArticleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new EntreeArticle([
        'IdEntree'    => $row['identree'] ?? null,
        'IMEI'        => $row['imei'] ?? null,
        'Id_Article'  => $row['id_article'],
        'Couleur'     => $row['couleur'] ?? null,
        'Capacite'    => $row['capacite'] ?? null,
        'quantite'    => $row['quantite'],
        'Etat'        => $row['etat'] ?? 'Scellé',
        'EntreePar'   => $row['entreepar'],
        'EntreeLe'    => $row['entreele'],
        'Statut'      => $row['statut'] ?? 'Disponible',
        'ModifierLe'  =>$row['modifierle'],
        'ModifierPar' => $row['modifierpar'],
        'NomFours'    => $row['nomfours'] ?? null,
        'TelFours'    => $row['telfours'],
        'Observations'=> $row['observations'],
        'DateEnreg'   => $row['dateenreg'],
        'HeureEnreg'  => $row['heureenreg'] ?? null,
        'PrixAchat'   => $row['prixachat'] ,
        'PrixVente'   => $row['prixvente'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
        ]);
    }
    private function convertDate($date)
    {
        // Vérifiez si la date est une valeur valide
        if (!$date || $date === "NULL" || strlen($date) < 6) {
            return null;
        }
    
        // Si la date est dans le format d/m/Y (jour à un chiffre)
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $date)) {
            // Remarquez que le format est d/m/Y et non pas d/m/Y
            return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
    
        // Si le format ne correspond pas, retournez null ou une valeur par défaut
        return null;
    }

    private function convertDateTime($dateTime)
    {
        if (!$dateTime || $dateTime === "NULL") {
            return null;
        }
        return \Carbon\Carbon::createFromFormat('d/m/Y H:i', $dateTime)->format('Y-m-d H:i:s');
    }
    
}
