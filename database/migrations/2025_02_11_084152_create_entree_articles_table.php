<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entree_articles', function (Blueprint $table) {
            $table->id('IdEntree');
            $table->string('IMEI')->unique()->nullable();
            $table->unsignedBigInteger('Id_Article');
            $table->string('Couleur')->nullable();
            $table->string('Capacite')->nullable();
            $table->string('Etat')->nullable();
            $table->unsignedBigInteger('EntreePar');
            $table->date('EntreeLe');
            $table->string('Statut');
            $table->date('ModifierLe')->nullable();
            $table->unsignedBigInteger('ModifierPar')->nullable();
            $table->string('NomFours');
            $table->string('TelFours');
            $table->text('Observations')->nullable();
            $table->date('DateEnreg');
            $table->time('HeureEnreg');
            $table->integer('PrixAchat');
            $table->integer('PrixVente');
            $table->timestamps();
            $table->foreign('Id_Article')
            ->references('IdArticle')
            ->on('articles')
            ->onDelete('cascade');
            $table->foreign('EntreePar')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('ModifierPar')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entree_articles');
    }
};
