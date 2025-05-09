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
        Schema::create('retour_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IdEntree');
            $table->string('IMEI');
            $table->string('RetourLe');
           
            $table->unsignedBigInteger('RetourPar')->nullable();
            $table->string('Observations');
            $table->date('DateEnreg');
            $table->time('HeureEnreg');
            $table->timestamps();
            $table->foreign('IdEntree')
            ->references('IdEntree')
            ->on('entree_articles')
            ->onDelete('cascade');
            $table->foreign('RetourPar')
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
        Schema::dropIfExists('retour_articles');
    }
};
