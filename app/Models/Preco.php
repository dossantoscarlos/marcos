<?php

namespace App\Models;

use Database\Factories\PrecoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Preco extends Model
{
    /** @use HasFactory<PrecoFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'produto_id',
        'desconto_id',
        'preco',
        'medida',
        'situacao',
        'extras',
    ];

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    public function desconto(): BelongsTo
    {
        return $this->belongsTo(Desconto::class);
    }
}
