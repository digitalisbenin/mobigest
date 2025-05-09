<?php

namespace App\Imports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ArticlesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        //dd($row);
        return new Article([
            'IdArticle' => $row['idarticle'], // Correspond à la clé en minuscule
            'Designation' => $row['designation'],
            'stock_Alert' => $row['stock_alert'],
            'stock_Art' => $row['stock_art'],
            'Entre_par' => $row['entre_par'],
            'Id_famille' => $row['id_famille'],
            'Entre_le' => $row['entre_le'],
            'Modifier_par' => $row['modifier_par'],
            'Modifier_le' => $row['modifier_le'],
            'Date_enreg' => $row['date_enreg'],
            'Heure_enreg' => $row['heure_enreg'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            // 'created_at' => $this->convertDateTime($row['created_at']),
            // 'updated_at' => $this->convertDateTime($row['updated_at']),
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
