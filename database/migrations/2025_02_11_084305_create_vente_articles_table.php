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
        Schema::create('vente_articles', function (Blueprint $table) {
            $table->id('IDVente');
            $table->integer('NumVente')->unique();
            $table->date('DateVente');
            $table->time('HeureVente');
            $table->unsignedBigInteger('EnregistrerPar');
            $table->integer('MontantVente');
            $table->text('Observations')->nullable();
            $table->unsignedBigInteger('IdEntree');
            $table->string('Statut');
            $table->integer('Espece')->nullable();
            $table->integer('MoMo')->nullable();
            $table->integer('AutreM')->nullable();
            $table->integer('Reste')->nullable();
            $table->date('DateEcheance')->nullable();
            $table->date('DateModif')->nullable();
            $table->time('HeureModif')->nullable();
            $table->unsignedBigInteger('ModifPar')->nullable();
            $table->date('DateAnnul')->nullable();
            $table->time('HeureAnnul')->nullable();
            $table->unsignedBigInteger('AnnulerPar')->nullable();

            $table->string('NomClient');
            $table->string('TelClient');
            $table->text('CauseAnnulat')->nullable();
            $table->integer('MargeBenefic')->nullable();
            $table->timestamps();

            // Définir la clé étrangère pour IdEntree
            $table->foreign('IdEntree')
                ->references('IdEntree')
                ->on('entree_articles')
                ->onDelete('cascade');

            // Définir la clé étrangère pour Enregister par
                $table->foreign('EnregistrerPar')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                $table->foreign('ModifPar')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                $table->foreign('AnnulerPar')
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
        Schema::dropIfExists('vente_articles');
    }
};
