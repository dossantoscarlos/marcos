<?php

namespace App\Models;

use Database\Factories\PromocaoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    /** @use HasFactory<PromocaoFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data_inicio' => 'date:Y-m-d',
            'data_fim' => 'date:Y-m-d',
        ];
    }

    /**
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'nome',
        'descricao',
        'percentual',
        'data_inicio',
        'data_fim',
        'situacao',
        'extras',
    ];
}
