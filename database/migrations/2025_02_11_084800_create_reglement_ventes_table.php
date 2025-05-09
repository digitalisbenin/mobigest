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
        Schema::create('reglement_ventes', function (Blueprint $table) {
         
            $table->id('IDReglement');
            $table->date('DateRegl');
            $table->integer('DetteAnt');
            $table->integer('MontantReglEsp');
            $table->integer('MontantReglMoMo')->nullable();
            $table->integer('DetteAct');
            $table->unsignedBigInteger('NumVente');
            $table->unsignedBigInteger('EnregistrerPar');
            $table->date('DateEnreg');
            $table->time('HeureEnreg');
            $table->timestamps();
            $table->foreign('EnregistrerPar')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('NumVente')
            ->references('IDVente')
            ->on('vente_articles')
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
        Schema::dropIfExists('reglement_ventes');
    }
};
