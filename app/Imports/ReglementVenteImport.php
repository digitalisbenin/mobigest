<?php

namespace App\Imports;

use App\Models\ReglementVente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReglementVenteImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd($row);
        return new ReglementVente([
        'IDReglement'       => $row['idreglement'],
        'IDVente'           => $row['idvente'],
        'DateEcheance'      => $row['dateecheance'],
        'Observations'      => $row['observations'],
        'DateRegl'          => $row['dateregl'],
        'DetteAnt'          => $row['detteant'],
        'MontantReglEsp'    => $row['montantreglesp'],
        'MontantReglMoMo'   => $row['montantreglmomo'],
        'DetteAct'          => $row['detteact'],
        'NumVente'          => $row['numvente'],
        'EnregistrerPar'    => $row['enregistrerpar'],
        'DateEnreg'         => $row['dateenreg'],
        'HeureEnreg'        => $row['heureenreg'],
        'created_at'        => $row['created_at'],
        'updated_at'        => $row['updated_at'],
        ]);
    }
}
