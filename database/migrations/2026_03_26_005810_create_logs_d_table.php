<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs_d', function (Blueprint $table) {
            $table->id();

            // usuário que fez a ação
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // tipo da ação (CRIAR, EDITAR, EXCLUIR...)
            $table->string('acao');

            // descrição do que aconteceu
            $table->text('descricao');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
