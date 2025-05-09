<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
/**
 * @property integer $id
 * @property integer $role_id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Article[] $articles
 * @property Article[] $articles
 * @property Caiss[] $caisses
 * @property Depense[] $depenses
 * @property EntreeArticle[] $entreeArticles
 * @property EntreeArticle[] $entreeArticles
 * @property ReglementVente[] $reglementVentes
 * @property RetourArticle[] $retourArticles
 * @property Role $role
 * @property VenteArticle[] $venteArticles
 * @property VenteArticle[] $venteArticles
 * @property VenteArticle[] $venteArticles
 */
class User extends Authenticatable
{
    use Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['role_id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'Entre_par');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articlese()
    {
        return $this->hasMany('App\Models\Article', 'Modifier_par');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function caisses()
    {
        return $this->hasMany('App\Models\Caiss', 'EnregistrerPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function depenses()
    {
        return $this->hasMany('App\Models\Depense', 'Enregister_par');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entreeArticles()
    {
        return $this->hasMany('App\Models\EntreeArticle', 'EntreePar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entreeArticlee()
    {
        return $this->hasMany('App\Models\EntreeArticle', 'ModifierPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reglementVentes()
    {
        return $this->hasMany('App\Models\ReglementVente', 'EnregistrerPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function retourArticles()
    {
        return $this->hasMany('App\Models\RetourArticle', 'RetourPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venteArticlese()
    {
        return $this->hasMany('App\Models\VenteArticle', 'ModifPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venteArticless()
    {
        return $this->hasMany('App\Models\VenteArticle', 'AnnulerPar');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venteArticles()
    {
        return $this->hasMany('App\Models\VenteArticle', 'EnregistrerPar');
    }
}
