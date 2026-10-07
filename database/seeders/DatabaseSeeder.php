<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Desconto;
use App\Models\Pagamento;
use App\Models\Pedido;
use App\Models\Preco;
use App\Models\Produto;
use App\Models\Promocao;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar Usuário de Teste
        User::updateOrCreate(
            ['email' => 'admin@email.com'],
            [
                'name' => 'Marcos Admin',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Criar Clientes (5 registros)
        $clientesData = [
            [
                'nome' => 'Ana Silva',
                'email' => 'ana.silva@email.com',
                'telefone' => '(11) 98765-4321',
                'endereco' => 'Av. Paulista, 1000',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01310-100',
                'status' => 'ativo',
            ],
            [
                'nome' => 'Carlos Oliveira',
                'email' => 'carlos.oli@email.com',
                'telefone' => '(21) 99888-7766',
                'endereco' => 'Rua Copacabana, 45',
                'cidade' => 'Rio de Janeiro',
                'estado' => 'RJ',
                'cep' => '22020-002',
                'status' => 'ativo',
            ],
            [
                'nome' => 'Beatriz Souza',
                'email' => 'beatriz.souza@email.com',
                'telefone' => '(31) 98877-6655',
                'endereco' => 'Rua da Bahia, 1200',
                'cidade' => 'Belo Horizonte',
                'estado' => 'MG',
                'cep' => '30160-011',
                'status' => 'ativo',
            ],
            [
                'nome' => 'João Santos',
                'email' => 'joao.santos@email.com',
                'telefone' => '(51) 97766-5544',
                'endereco' => 'Rua dos Andradas, 500',
                'cidade' => 'Porto Alegre',
                'estado' => 'RS',
                'cep' => '90020-005',
                'status' => 'ativo',
            ],
            [
                'nome' => 'Mariana Lima',
                'email' => 'mariana.lima@email.com',
                'telefone' => '(41) 96655-4433',
                'endereco' => 'Rua XV de Novembro, 300',
                'cidade' => 'Curitiba',
                'estado' => 'PR',
                'cep' => '80020-300',
                'status' => 'inativo',
            ],
        ];

        $clientes = [];
        foreach ($clientesData as $data) {
            $clientes[] = Cliente::create([
                ...$data,
                'uuid' => (string) Str::uuid(),
                'extras' => json_encode(['origem' => 'Seeder Inicial', 'limite_credito' => rand(1000, 5000)]),
            ]);
        }

        // 3. Criar Produtos (5 registros)
        $produtosData = [
            [
                'nome' => 'Notebook Pro 15',
                'sku' => 'NOTE-PRO-15',
                'descricao' => 'Notebook de alta performance com processador de última geração, 16GB RAM e SSD de 512GB.',
                'preco' => 4500.00,
                'imagem' => 'notebook.jpg',
                'categoria' => 'Tecnologia',
                'subcategoria' => 'Computadores',
                'marca' => 'TechCorp',
                'modelo' => 'Pro 15"',
                'cor' => 'Cinza Espacial',
                'tamanho' => 'Médio',
                'material' => 'Alumínio',
                'tipo' => 'Portátil',
                'status' => 'ativo',
                'tags' => 'notebook,tech,trabalho',
            ],
            [
                'nome' => 'Smartphone X10',
                'sku' => 'SMART-X10',
                'descricao' => 'Celular de última geração com câmera tripla de 64MP e bateria de longa duração.',
                'preco' => 2499.90,
                'imagem' => 'smartphone.jpg',
                'categoria' => 'Tecnologia',
                'subcategoria' => 'Celulares',
                'marca' => 'Phonix',
                'modelo' => 'X10',
                'cor' => 'Preto',
                'tamanho' => 'Único',
                'material' => 'Vidro e Metal',
                'tipo' => 'Eletrônico',
                'status' => 'ativo',
                'tags' => 'smartphone,celular,camera',
            ],
            [
                'nome' => 'Mochila Executive Impermeável',
                'sku' => 'MOC-EXEC-IMP',
                'descricao' => 'Mochila ideal para trabalho e viagens, resistente à água e com compartimento para notebook de até 17 polegadas.',
                'preco' => 289.00,
                'imagem' => 'mochila.jpg',
                'categoria' => 'Acessórios',
                'subcategoria' => 'Bolsas e Mochilas',
                'marca' => 'BagCo',
                'modelo' => 'Executive',
                'cor' => 'Azul Escuro',
                'tamanho' => 'Grande',
                'material' => 'Nylon Balístico',
                'tipo' => 'Cotidiano',
                'status' => 'ativo',
                'tags' => 'mochila,impermeavel,viagem',
            ],
            [
                'nome' => 'Cadeira Ergonômica Office',
                'sku' => 'CAD-ERGO-OFF',
                'descricao' => 'Cadeira de escritório ergonômica com regulagem de altura, encosto para cabeça e apoio de braços 3D.',
                'preco' => 1290.00,
                'imagem' => 'cadeira.jpg',
                'categoria' => 'Móveis',
                'subcategoria' => 'Cadeiras',
                'marca' => 'ComfortPlus',
                'modelo' => 'Office Ergo',
                'cor' => 'Preta',
                'tamanho' => 'Único',
                'material' => 'Tela Mesh e Aço',
                'tipo' => 'Escritório',
                'status' => 'ativo',
                'tags' => 'cadeira,ergonomia,escritorio',
            ],
            [
                'nome' => 'Teclado Mecânico RGB',
                'sku' => 'TEC-MEC-RGB',
                'descricao' => 'Teclado mecânico gamer com switches silenciosos e iluminação RGB customizável.',
                'preco' => 450.00,
                'imagem' => 'teclado.jpg',
                'categoria' => 'Tecnologia',
                'subcategoria' => 'Acessórios',
                'marca' => 'GamerKey',
                'modelo' => 'RGB Mec',
                'cor' => 'Grafite',
                'tamanho' => 'Completo',
                'material' => 'Plástico ABS',
                'tipo' => 'Periférico',
                'status' => 'ativo',
                'tags' => 'teclado,mecanico,rgb,gamer',
            ],
        ];

        $produtos = [];
        foreach ($produtosData as $data) {
            $produtos[] = Produto::create([
                ...$data,
                'uuid' => (string) Str::uuid(),
                'slug' => Str::slug($data['nome']),
                'extras' => json_encode(['garantia_meses' => 12, 'estoque' => rand(10, 100)]),
            ]);
        }

        // 4. Criar Descontos (3 registros)
        $descontosData = [
            [
                'nome' => 'Desconto PIX / Boleto',
                'descricao' => 'Desconto padrão concedido para pagamentos à vista via PIX ou Boleto Bancário.',
                'percentual' => 10.00,
                'situacao' => 'ativo',
            ],
            [
                'nome' => 'Desconto de Fidelidade',
                'descricao' => 'Desconto especial para clientes que compram frequentemente na loja.',
                'percentual' => 15.00,
                'situacao' => 'ativo',
            ],
            [
                'nome' => 'Desconto Temporário / Outlet',
                'descricao' => 'Desconto aplicado para queima de estoque remanescente.',
                'percentual' => 20.00,
                'situacao' => 'inativo',
            ],
        ];

        $descontos = [];
        foreach ($descontosData as $data) {
            $descontos[] = Desconto::create([
                ...$data,
                'uuid' => (string) Str::uuid(),
                'extras' => json_encode(['tipo_aplicacao' => 'automatica']),
            ]);
        }

        // 5. Criar Promoções (2 registros)
        $promocoesData = [
            [
                'nome' => 'Liquidação de Inverno',
                'descricao' => 'Promoção geral do mês de inverno com ótimos descontos.',
                'percentual' => 25.00,
                'data_inicio' => now()->subDays(5)->format('Y-m-d'),
                'data_fim' => now()->addDays(25)->format('Y-m-d'),
                'situacao' => 'ativo',
            ],
            [
                'nome' => 'Semana do Consumidor',
                'descricao' => 'Promoção especial da semana dedicada aos nossos clientes.',
                'percentual' => 30.00,
                'data_inicio' => now()->addDays(10)->format('Y-m-d'),
                'data_fim' => now()->addDays(17)->format('Y-m-d'),
                'situacao' => 'ativo',
            ],
        ];

        foreach ($promocoesData as $data) {
            Promocao::create([
                ...$data,
                'uuid' => (string) Str::uuid(),
                'extras' => json_encode(['abrangencia' => 'nacional']),
            ]);
        }

        // 6. Criar Preços para Produtos (5 registros)
        foreach ($produtos as $index => $prod) {
            // Alguns produtos ganham desconto relacionado
            $descontoId = ($index % 2 === 0) ? $descontos[0]->id : null;

            Preco::create([
                'uuid' => (string) Str::uuid(),
                'produto_id' => $prod->id,
                'desconto_id' => $descontoId,
                'preco' => $prod->preco,
                'medida' => 'unidade',
                'situacao' => 'ativo',
                'extras' => json_encode(['tabela' => 'Varejo Padrão']),
            ]);
        }

        // 7. Criar Pedidos (4 registros)
        $pedidosData = [
            [
                'cliente_index' => 0, // Ana Silva
                'produto_index' => 0, // Notebook
                'codigo_pedido' => 'PED-2026-0001',
                'situacao' => 'entregue',
            ],
            [
                'cliente_index' => 1, // Carlos Oliveira
                'produto_index' => 1, // Smartphone
                'codigo_pedido' => 'PED-2026-0002',
                'situacao' => 'processando',
            ],
            [
                'cliente_index' => 2, // Beatriz Souza
                'produto_index' => 2, // Mochila
                'codigo_pedido' => 'PED-2026-0003',
                'situacao' => 'pendente',
            ],
            [
                'cliente_index' => 3, // João Santos
                'produto_index' => 3, // Cadeira
                'codigo_pedido' => 'PED-2026-0004',
                'situacao' => 'cancelado',
            ],
        ];

        $pedidos = [];
        foreach ($pedidosData as $pData) {
            $pedidos[] = Pedido::create([
                'cliente_id' => $clientes[$pData['cliente_index']]->id,
                'produto_id' => $produtos[$pData['produto_index']]->id,
                'codigo_pedido' => $pData['codigo_pedido'],
                'situacao' => $pData['situacao'],
                'extras' => json_encode(['nota_fiscal' => 'NF-'.rand(100000, 999999)]),
            ]);
        }

        // 8. Criar Pagamentos para Pedidos
        // Pedido 1: Pago
        Pagamento::create([
            'uuid' => (string) Str::uuid(),
            'cliente_id' => $pedidos[0]->cliente_id,
            'pedido_id' => $pedidos[0]->id,
            'valor' => 4500.00,
            'situacao' => 'pago',
            'observacoes' => 'Pagamento efetuado via PIX à vista com sucesso.',
            'data_estimada_pagamento' => now()->subDays(2)->format('Y-m-d H:i:s'),
            'data_evetiva_pagamento' => now()->subDays(2)->format('Y-m-d H:i:s'),
            'evidencia' => 'comprovante_pix_49204.pdf',
            'tipo' => 'pix',
            'extras' => json_encode(['instituicao' => 'Banco do Brasil']),
        ]);

        // Pedido 2: Processando / Pendente
        Pagamento::create([
            'uuid' => (string) Str::uuid(),
            'cliente_id' => $pedidos[1]->cliente_id,
            'pedido_id' => $pedidos[1]->id,
            'valor' => 2499.90,
            'situacao' => 'processando',
            'observacoes' => 'Cartão de crédito aprovado, aguardando compensação.',
            'data_estimada_pagamento' => now()->addDay()->format('Y-m-d H:i:s'),
            'data_evetiva_pagamento' => null,
            'evidencia' => null,
            'tipo' => 'cartao_credito',
            'extras' => json_encode(['parcelas' => 10]),
        ]);

        // Pedido 3: Pendente
        Pagamento::create([
            'uuid' => (string) Str::uuid(),
            'cliente_id' => $pedidos[2]->cliente_id,
            'pedido_id' => $pedidos[2]->id,
            'valor' => 289.00,
            'situacao' => 'pendente',
            'observacoes' => 'Boleto bancário emitido. Aguardando pagamento.',
            'data_estimada_pagamento' => now()->addDays(3)->format('Y-m-d H:i:s'),
            'data_evetiva_pagamento' => null,
            'evidencia' => null,
            'tipo' => 'boleto',
            'extras' => json_encode(['nosso_numero' => '8294902482']),
        ]);
    }
}
