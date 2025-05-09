<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $EnregistrerPar
 * @property string $date
 * @property string $MontantVente
 * @property string $MontantEspece
 * @property string $MontantMoMo
 * @property string $MontantDepense
 * @property string $MontantRestant
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Caisse extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['EnregistrerPar', 'date', 'MontantVente', 'MontantEspece', 'MontantMoMo', 'MontantDepense', 'MontantRestant', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'EnregistrerPar');
    }
}
