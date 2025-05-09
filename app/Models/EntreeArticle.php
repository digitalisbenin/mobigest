<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $IdEntree
 * @property string $IMEI
 * @property integer $Id_Article
 * @property string $Couleur
 * @property string $Capacite
 * @property string $Etat
 * @property integer $EntreePar
 * @property string $EntreeLe
 * @property string $Statut
 * @property string $ModifierLe
 * @property integer $ModifierPar
 * @property string $NomFours
 * @property string $TelFours
 * @property string $Observations
 * @property string $DateEnreg
 * @property string $HeureEnreg
 * @property integer $PrixAchat
 * @property integer $PrixVente
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 * @property Article $article
 * @property RetourArticle[] $retourArticles
 * @property VenteArticle[] $venteArticles
 */
class EntreeArticle extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'IdEntree';

    /**
     * @var array
     */
    protected $fillable = ['IMEI', 'quantite', 'Id_Article', 'Couleur', 'Capacite', 'Etat', 'EntreePar', 'EntreeLe', 'Statut', 'ModifierLe', 'ModifierPar', 'NomFours', 'TelFours', 'Observations', 'DateEnreg', 'HeureEnreg', 'PrixAchat', 'PrixVente', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'EntreePar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'ModifierPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articlee()
    {
        return $this->belongsTo('App\Models\Article', 'Id_Article', 'IdArticle');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function retourArticles()
    {
        return $this->hasMany('App\Models\RetourArticle', 'IdEntree', 'IdEntree');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venteArticles()
    {
        return $this->hasMany('App\Models\VenteArticle', 'IdEntree', 'IdEntree');
    }
}
