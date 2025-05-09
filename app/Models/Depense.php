<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $NumDepense
 * @property string $DateDepense
 * @property string $HeureDepense
 * @property string $MotifDepense
 * @property integer $MontantDepense
 * @property string $Observations
 * @property integer $Enregister_par
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Depense extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['NumDepense', 'DateDepense', 'HeureDepense', 'MotifDepense', 'MontantDepense', 'Observations', 'Enregister_par', 'created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($vente) {
            $vente->NumDepense = self::max('NumDepense') + 1; // Numéro de vente unique
        });
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'Enregister_par');
    }
}
