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
        Schema::create('lojas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 40)->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE lojas ADD CONSTRAINT check_nome_length CHECK (CHAR_LENGTH(nome) <= 40 AND CHAR_LENGTH(nome) >= 3)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lojas');
    }
};
