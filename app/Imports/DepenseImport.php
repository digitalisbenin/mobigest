<?php

namespace App\Imports;

use App\Models\Depense;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class DepenseImport implements ToModel, WithHeadingRow
{
    /**
     * Convertit une date Excel (format "dd/mm/yyyy") en format Laravel ("Y-m-d").
     */
    private function convertDate($date)
    {
        if (!$date || $date === "NULL") {
            return null;
        }
        return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    /**
     * Convertit une heure Excel (format "HH:MM") en format Laravel ("H:i:s").
     */
    private function convertTime($time)
    {
        if (!$time || $time === "NULL") {
            return null;
        }
        return Carbon::createFromFormat('H:i', $time)->format('H:i:s');
    }

   
    public function model(array $row)
    {
        return new Depense([
            //'NumDepense' => Depense::max('NumDepense') + 1, // Auto-incrémentation du numéro de dépense
            'NumDepense' => $row['numdepense'],
            'DateDepense' => $row['datedepense'],
            'HeureDepense' => $row['heuredepense'],
            'MotifDepense' => $row['motifdepense'],
            'MontantDepense' => $row['montantdepense'],
            'Observations' => $row['observations'],
            'Enregister_par' => $row['enregister_par'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }
}
