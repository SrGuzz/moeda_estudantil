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
        Schema::create('resgates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('vantagem_id');
            $table->integer('valor');
            $table->integer('status');
            $table->string('codigo_resgate');

            $table->foreign('aluno_id')
                ->references('id')
                ->on('alunos')
                ->restrictOnDelete();

            $table->foreign('vantagem_id')
                ->references('id')
                ->on('vantagens')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resgates');
    }
};
