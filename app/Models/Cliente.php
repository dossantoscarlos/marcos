<?php

namespace App\Models;

use Database\Factories\ClienteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    /** @use HasFactory<ClienteFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'nome',
        'email',
        'telefone',
        'endereco',
        'cidade',
        'estado',
        'cep',
        'status',
        'extras',
    ];

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }

    public function pagamentos(): HasMany
    {
        return $this->hasMany(Pagamento::class);
    }
}
