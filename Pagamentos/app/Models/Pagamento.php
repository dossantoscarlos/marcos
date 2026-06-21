<?php

namespace App\Models;

use Database\Factories\PagamentoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model
{
    /** @use HasFactory<PagamentoFactory> */
    use HasFactory;

    use SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'cliente_id',
        'pedido_id',
        'valor',
        'situacao',
        'observacoes',
        'data_estimada_pagamento',
        'data_evetiva_pagamento',
        'evidencia',
        'tipo',
        'extras',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }
}
