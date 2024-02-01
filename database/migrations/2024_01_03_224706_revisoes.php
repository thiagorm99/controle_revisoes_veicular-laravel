<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('revisoes', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('km');
            $table->string('tipo_revisao');
            $table->string('custo');
            $table->unsignedBigInteger('id_veiculo');
            $table->timestamps();

            $table->foreign('id_veiculo')->references('id')->on('veiculos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('revisoes');
    }
};
