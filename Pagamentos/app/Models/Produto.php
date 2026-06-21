<?php

namespace App\Models;

use Database\Factories\ProdutoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    /** @use HasFactory<ProdutoFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'nome',
        'slug',
        'sku',
        'descricao',
        'preco',
        'imagem',
        'categoria',
        'subcategoria',
        'marca',
        'modelo',
        'cor',
        'tamanho',
        'material',
        'estilo',
        'tipo',
        'genero',
        'idade',
        'status',
        'tags',
        'extras',
    ];

    public function precos(): HasMany
    {
        return $this->hasMany(Preco::class);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }
}
