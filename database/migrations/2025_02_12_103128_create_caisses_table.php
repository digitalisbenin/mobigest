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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EnregistrerPar');
            $table->date('date');
            $table->date('MontantVente');
            $table->date('MontantEspece');
            $table->date('MontantMoMo');
            $table->date('MontantDepense');
            $table->date('MontantRestant');

            $table->timestamps();
            $table->foreign('EnregistrerPar')
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
        Schema::dropIfExists('caisses');
    }
};
