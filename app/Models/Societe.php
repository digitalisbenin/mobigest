<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $NomSociete
 * @property string $Adresse
 * @property string $CodePostal
 * @property string $Ville
 * @property string $Telephone
 * @property string $Fax
 * @property string $email
 * @property string $Logo
 * @property string $responsable
 * @property string $ifu
 * @property string $rccm
 * @property string $created_at
 * @property string $updated_at
 */
class Societe extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['NomSociete', 'responsable', 'ifu','rccm', 'Adresse', 'CodePostal', 'Ville', 'Telephone', 'Fax', 'email', 'Logo', 'created_at', 'updated_at'];
}
