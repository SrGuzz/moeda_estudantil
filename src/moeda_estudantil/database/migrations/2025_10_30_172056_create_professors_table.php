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
        Schema::create('professores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cpf')->unique();
            $table->string('departamento');
            $table->integer('saldo_moedas', 12, 2)->default(1000);
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('empresa_id')
                ->references('id')
                ->on('empresas')
                ->cascadeOnDelete();
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professores');
    }
};
