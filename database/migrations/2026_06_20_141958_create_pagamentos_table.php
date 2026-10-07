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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('cliente_id')->constrained()->cascadeOnDelete();
            $table->integer('pedido_id')->constrained()->cascadeOnDelete();
            $table->decimal('valor', 10, 2);
            $table->string('situacao')->default('pendente');
            $table->string('observacoes')->nullable();
            $table->string('data_estimada_pagamento')->default(now());
            $table->string('data_evetiva_pagamento')->nullable();
            $table->string('evidencia')->nullable();
            $table->string('tipo')->default('dinheiro');
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
        Schema::dropIfExists('pagamentos');
    }
};
