<?php

namespace App\Imports;

use App\Models\RetourArticle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RetourArticleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new RetourArticle([
        'id' => $row['id'], 
        'IdEntree' => $row['identree'],  // Assurez-vous que l'index correspond à la colonne
        'IMEI' => $row['imei'],
        'RetourLe' =>$row['retourle'],
        'RetourPar' => $row['retourpar'],
        'Observations' => $row['observations'],
        //'DateEnreg' => isset($row[6]) ? \Carbon\Carbon::createFromFormat('d/m/Y', $row[6])->format('Y-m-d') : null,
        'DateEnreg' => $row['dateenreg'],
        'HeureEnreg' => $row['heureenreg'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at'],
        ]);
    }

    

    /**
     * Convertit une date Excel (format "dd/mm/yyyy") en format Laravel ("Y-m-d").
     */
    
     private function convertDate($date)
    {
        if (!$date || $date === "NULL") {
            return null;
        }
        return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
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
