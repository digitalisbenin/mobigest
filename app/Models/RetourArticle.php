<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $IdEntree
 * @property string $IMEI
 * @property string $RetourLe
 * @property integer $RetourPar
 * @property string $Observations
 * @property string $DateEnreg
 * @property string $HeureEnreg
 * @property string $created_at
 * @property string $updated_at
 * @property EntreeArticle $entreeArticle
 * @property User $user
 */
class RetourArticle extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['IdEntree', 'IMEI', 'RetourLe', 'RetourPar', 'Observations', 'DateEnreg', 'HeureEnreg', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entreeArticle()
    {
        return $this->belongsTo('App\Models\EntreeArticle', 'IdEntree', 'IdEntree');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'RetourPar');
    }
}
