<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $IdArticle
 * @property string $Designation
 * @property string $PA_Art
 * @property string $PVA_Art1
 * @property string $PVA_Art2
 * @property string $PVA_Art3
 * @property string $stock_Art
 * @property integer $Entre_par
 * @property integer $Id_famille
 * @property string $Entre_le
 * @property integer $Modifier_par
 * @property string $Modifier_le
 * @property string $Date_enreg
 * @property string $Heure_enreg
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 * @property Famille $famille
 * @property EntreeArticle[] $entreeArticles
 */
class Article extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IdArticle';

    /**
     * @var array
     */
    protected $fillable = ['Designation', 'stock_Alert',  'stock_Art', 'Entre_par', 'Id_famille', 'Entre_le', 'Modifier_par', 'Modifier_le', 'Date_enreg', 'Heure_enreg', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'Entre_par');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'Modifier_par');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function famille()
    {
        return $this->belongsTo('App\Models\Famille', 'Id_famille', 'IDFamille');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entreeArticles()
    {
        return $this->hasMany('App\Models\EntreeArticle', 'Id_Article', 'IdArticle');
    }
}
