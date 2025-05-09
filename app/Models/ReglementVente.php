<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $IDReglement
 * @property integer $IDVente
 * @property string $Observations
 * @property string $DateRegl
 * @property integer $DetteAnt
 * @property integer $MontantReglEsp
 * @property integer $MontantReglMoMo
 * @property integer $DetteAct
 * @property integer $NumVente
 * @property integer $EnregistrerPar
 * @property string $DateEnreg
 * @property string $HeureEnreg
 * @property string $created_at
 * @property string $updated_at
 * @property VenteArticle $venteArticle
 * @property VenteArticle $venteArticle
 * @property User $user
 */
class ReglementVente extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDReglement';

    /**
     * @var array
     */
    protected $fillable = ['IDVente', 'DateEcheance' ,'Observations', 'DateRegl', 'DetteAnt', 'MontantReglEsp', 'MontantReglMoMo', 'DetteAct', 'NumVente', 'EnregistrerPar', 'DateEnreg', 'HeureEnreg', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reglementVente()
    {
        return $this->belongsTo('App\Models\VenteArticle', 'IDVente', 'IDVente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venteArticles()
    {
        return $this->belongsTo('App\Models\VenteArticle', 'NumVente', 'IDVente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'EnregistrerPar');
    }
}
