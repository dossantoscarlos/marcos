<?php

namespace App\Models;

use Database\Factories\DescontoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desconto extends Model
{
    /** @use HasFactory<DescontoFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'nome',
        'descricao',
        'percentual',
        'situacao',
        'extras',
    ];

    public function precos(): HasMany
    {
        return $this->hasMany(Preco::class);
    }
}
