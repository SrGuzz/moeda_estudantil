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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('rg')->unique();
            $table->string('curso');
            $table->string('instituicao');
            $table->integer('saldo_moedas', 12, 2)->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('endereco_id')->unique()->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('endereco_id')
                ->references('id')
                ->on('enderecos')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
