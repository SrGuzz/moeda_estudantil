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
        Schema::create('vantagens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome')->unique();
            $table->string('descricao');
            $table->unsignedBigInteger('empresa_id');
            $table->integer('valor');
            $table->string('foto');

            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vantagens');
    }
};
