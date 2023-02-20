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

        DB::statement('ALTER TABLE produtos ADD CONSTRAINT check_nome_prod_length CHECK (CHAR_LENGTH(nome) <= 60 AND CHAR_LENGTH(nome) >= 3)');
        DB::statement('ALTER TABLE produtos ADD CONSTRAINT check_valor_range CHECK (valor >= 2 AND valor <= 6)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};