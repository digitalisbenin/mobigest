<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $IDFamille
 * @property string $LibFamille
 * @property string $created_at
 * @property string $updated_at
 * @property Article[] $articles
 */
class Famille extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'IDFamille';

    /**
     * @var array
     */
    protected $fillable = ['LibFamille', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article', 'Id_famille', 'IDFamille');
    }
}
