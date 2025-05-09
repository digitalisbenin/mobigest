<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $IDVente
 * @property integer $NumVente
 * @property string $quantite
 * @property string $DateVente
 * @property string $HeureVente
 * @property integer $EnregistrerPar
 * @property integer $MontantVente
 * @property string $Observations
 * @property integer $IdEntree
 * @property string $Statut
 * @property integer $Espece
 * @property integer $MoMo
 * @property integer $AutreM
 * @property integer $Reste
 * @property string $DateEcheance
 * @property string $DateModif
 * @property string $HeureModif
 * @property integer $ModifPar
 * @property string $DateAnnul
 * @property string $HeureAnnul
 * @property integer $AnnulerPar
 * @property string $NomClient
 * @property string $TelClient
 * @property string $CauseAnnulat
 * @property integer $MargeBenefic
 * @property string $created_at
 * @property string $updated_at
 * @property ReglementVente[] $reglementVentes
 * @property User $user
 * @property User $user
 * @property EntreeArticle $entreeArticle
 * @property User $user
 */
class VenteArticle extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDVente';

    /**
     * @var array
     */
    protected $fillable = ['NumVente', 'quantite', 'DateVente', 'HeureVente', 'EnregistrerPar', 'MontantVente', 'Observations', 'IdEntree', 'Statut', 'Espece', 'MoMo', 'AutreM', 'Reste', 'DateEcheance', 'DateModif', 'HeureModif', 'ModifPar', 'DateAnnul', 'HeureAnnul', 'AnnulerPar', 'NomClient', 'TelClient', 'CauseAnnulat', 'MargeBenefic', 'created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($vente) {
            $vente->NumVente = self::max('NumVente') + 1; // Numéro de vente unique
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reglementVentes()
    {
        return $this->hasMany('App\Models\ReglementVente', 'NumVente', 'IDVente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'ModifPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'AnnulerPar');
    }

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
    public function usere()
    {
        return $this->belongsTo('App\Models\User', 'EnregistrerPar');
    }
}
