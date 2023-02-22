<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 60)->nullable(false);
            $table->integer('valor')->nullable(false);
            $table->unsignedBigInteger('loja_id')->nullable(false);
            $table->foreign('loja_id')->references('id')->on('lojas');
            $table->boolean('ativo')->default(false);
            $table->integer('estoque')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};