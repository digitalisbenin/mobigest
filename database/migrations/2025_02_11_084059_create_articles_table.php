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
        Schema::create('articles', function (Blueprint $table) {
            $table->id('IdArticle');
            // $table->string('Code_art')->unique();
            $table->string('Designation')->unique();
            $table->string('PA_Art');
            $table->string('PVA_Art1');
            $table->string('PVA_Art2');
            $table->string('PVA_Art3');
            $table->string('stock_Art');
            $table->unsignedBigInteger('Entre_par')->nullable();
            $table->unsignedBigInteger('Id_famille')->nullable();
            $table->date('Entre_le');
            $table->unsignedBigInteger('Modifier_par')->nullable();
            $table->string('Modifier_le');
            $table->date('Date_enreg');
            $table->time('Heure_enreg');
            $table->timestamps();
             $table->foreign('Entre_par')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('Modifier_par')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->foreign('Id_famille')
            ->references('IDFamille')
            ->on('familles')
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
        Schema::dropIfExists('articles');
    }
};
