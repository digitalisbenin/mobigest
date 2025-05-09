<?php

namespace App\Imports;

use App\Models\Famille;
use Maatwebsite\Excel\Concerns\ToModel;

class FamilleImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new Famille([
            'IDFamille' => $row[0] ?? null,
            'LibFamille' => $row[1] ?? null, // Vous devez vérifier la position exacte des données dans votre fichier Excel
           //'created_at' => $this->convertDateTime($row[2]),
            //'updated_at' => $this->convertDateTime($row[3]),
        ]);
    }

     /**
     * Convertit une date/heure Excel (format "dd/mm/yyyy HH:MM") en format Laravel ("Y-m-d H:i:s").
     */
    private function convertDateTime($dateTime)
    {
        if (!$dateTime || $dateTime === "NULL") {
            return null;
        }
        return \Carbon\Carbon::createFromFormat('d/m/Y H:i', $dateTime)->format('Y-m-d H:i:s');
    }
}
