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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('nome');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('descricao');
            $table->decimal('preco', 10, 2);
            $table->string('imagem');
            $table->string('categoria');
            $table->string('subcategoria');
            $table->string('marca');
            $table->string('modelo');
            $table->string('cor');
            $table->string('tamanho');
            $table->string('material');
            $table->string('estilo')->nullable();
            $table->string('tipo');
            $table->string('genero')->nullable();
            $table->string('idade')->nullable();
            $table->string('status')->default('ativo');
            $table->string('tags')->nullable();
            $table->json('extras')->nullable();
            $table->softDeletes();
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
