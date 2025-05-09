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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->integer('NumDepense')->unique();
            $table->date('DateDepense');
            $table->time('HeureDepense');
            $table->string('MotifDepense');
            $table->integer('MontantDepense');
            $table->string('Observations');
            $table->unsignedBigInteger('Enregister_par')->nullable();
            $table->timestamps();
            $table->foreign('Enregister_par')
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
        Schema::dropIfExists('depenses');
    }
};
