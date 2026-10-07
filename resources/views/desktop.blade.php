<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de Pagamentos - Desktop OS</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-image: url('/wallpaper.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            user-select: none;
        }
        
        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .font-mono {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden relative flex flex-col antialiased">

    <!-- Area de Trabalho (Desktop Workspace) -->
    <div id="desktop-workspace" class="flex-1 w-full relative p-4 overflow-hidden z-10">
        
        <!-- Shortcuts Grid (Atalhos) -->
        <div id="desktop-shortcuts" class="grid grid-flow-col auto-cols-max grid-rows-6 gap-x-6 gap-y-4 justify-start items-start w-max h-full max-h-[calc(100vh-80px)] select-none">
            <!-- Shortcuts are rendered here dynamically -->
        </div>

        <!-- Desktop Windows Container -->
        <div id="windows-container" class="absolute inset-0 pointer-events-none z-20">
            <!-- Windows are rendered here dynamically -->
        </div>
        
    </div>

    <!-- Barra de Tarefas (Taskbar) -->
    <div class="w-full h-12 flex items-center justify-between px-3 select-none ext-taskbar z-[9999]">
        <!-- Iniciar & Quick Launch -->
        <div class="flex items-center gap-2">
            <button id="start-btn" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white font-medium font-outfit text-sm px-4 py-1.5 rounded shadow-lg border border-blue-400/30 transition-all cursor-pointer">
                <!-- Windows/ExtJS style icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span>Iniciar</span>
            </button>
            <div class="h-6 w-px bg-slate-700/50 mx-1"></div>
            <!-- Quick links -->
            <button onclick="DesktopApp.openWindow('pagamentos')" title="Novo Pagamento" class="p-1.5 hover:bg-slate-700/40 active:bg-slate-700/60 rounded text-slate-300 hover:text-white transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </button>
            <button onclick="DesktopApp.openWindow('pedidos')" title="Novo Pedido" class="p-1.5 hover:bg-slate-700/40 active:bg-slate-700/60 rounded text-slate-300 hover:text-white transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </button>
        </div>

        <!-- Open Windows on Taskbar -->
        <div id="taskbar-tasks" class="flex-1 flex items-center justify-start gap-1.5 px-4 overflow-x-auto h-full ext-scrollbar">
            <!-- Task buttons rendered here dynamically -->
        </div>

        <!-- System Tray -->
        <div class="flex items-center gap-3 text-slate-300 font-outfit text-xs pr-1">
            <!-- Connection Status -->
            <div class="flex items-center gap-1 bg-slate-800/60 border border-slate-700/40 px-2.5 py-1 rounded-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-slate-400 font-medium">Online</span>
            </div>
            
            <div class="h-6 w-px bg-slate-700/50"></div>
            
            <!-- Date & Clock -->
            <div class="text-right flex flex-col justify-center leading-none">
                <span id="tray-time" class="text-slate-100 font-semibold text-sm">00:00:00</span>
                <span id="tray-date" class="text-[10px] text-slate-400 mt-0.5">21/06/2026</span>
            </div>
        </div>
    </div>

    <!-- Menu Iniciar (Start Menu Overlay) -->
    <div id="start-menu" class="hidden absolute bottom-14 left-3 w-80 bg-slate-900/95 border border-slate-700/50 rounded-lg backdrop-blur-xl overflow-hidden ext-start-menu z-[10000] select-none text-white">
        <!-- User Section -->
        <div class="bg-gradient-to-r from-blue-700 to-indigo-800 p-4 flex items-center gap-3 border-b border-slate-700/40">
            <div class="w-10 h-10 rounded-full bg-blue-500 border-2 border-white/20 flex items-center justify-center font-bold font-outfit text-lg">
                M
            </div>
            <div>
                <h4 class="font-semibold text-sm font-outfit leading-none">Marcos Admin</h4>
                <p class="text-xs text-blue-200 mt-1">Administrador do Sistema</p>
            </div>
        </div>
        <!-- Menu Content -->
        <div class="grid grid-cols-1 divide-y divide-slate-800">
            <div class="p-2 space-y-0.5">
                <p class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider px-3 py-1">Programas</p>
                <a href="#" onclick="DesktopApp.openWindow('clientes'); DesktopApp.toggleStartMenu();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-800/60 text-sm transition-all group">
                    <span class="p-1 rounded bg-indigo-500/20 text-indigo-400 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </span>
                    <span>Clientes</span>
                </a>
                <a href="#" onclick="DesktopApp.openWindow('produtos'); DesktopApp.toggleStartMenu();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-800/60 text-sm transition-all group">
                    <span class="p-1 rounded bg-teal-500/20 text-teal-400 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </span>
                    <span>Produtos</span>
                </a>
                <a href="#" onclick="DesktopApp.openWindow('descontos'); DesktopApp.toggleStartMenu();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-800/60 text-sm transition-all group">
                    <span class="p-1 rounded bg-rose-500/20 text-rose-400 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span>Descontos</span>
                </a>
                <a href="#" onclick="DesktopApp.openWindow('promocoes'); DesktopApp.toggleStartMenu();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-800/60 text-sm transition-all group">
                    <span class="p-1 rounded bg-amber-500/20 text-amber-400 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </span>
                    <span>Promoções</span>
                </a>
                <a href="#" onclick="DesktopApp.openWindow('precos'); DesktopApp.toggleStartMenu();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-800/60 text-sm transition-all group">
                    <span class="p-1 rounded bg-emerald-500/20 text-emerald-400 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V5" />
                        </svg>
                    </span>
                    <span>Preços</span>
                </a>
                <a href="#" onclick="DesktopApp.openWindow('pedidos'); DesktopApp.toggleStartMenu();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-800/60 text-sm transition-all group">
                    <span class="p-1 rounded bg-blue-500/20 text-blue-400 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </span>
                    <span>Pedidos</span>
                </a>
                <a href="#" onclick="DesktopApp.openWindow('pagamentos'); DesktopApp.toggleStartMenu();" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-slate-800/60 text-sm transition-all group">
                    <span class="p-1 rounded bg-purple-500/20 text-purple-400 group-hover:scale-105 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </span>
                    <span>Pagamentos</span>
                </a>
            </div>
            
            <div class="p-2 flex justify-between items-center text-xs text-slate-500 px-4">
                <span>V1.0 - ExtJS Simulation</span>
                <button onclick="location.reload()" class="text-blue-400 hover:text-blue-300 font-semibold transition-all cursor-pointer">Reiniciar</button>
            </div>
        </div>
    </div>

    <!-- Notification Toast System -->
    <div id="toast-container" class="fixed top-4 right-4 z-[99999] flex flex-col gap-2 pointer-events-none select-none">
        <!-- Toasts are dynamically added here -->
    </div>

    <!-- Desktop App Logic (Vanilla JS JS) -->
    <script>
        // State and Cache Management
        const DesktopApp = {
            activeWindowId: null,
            openWindows: {},
            windowZIndex: 100,
            activeShortcut: null,
            cache: {
                clientes: [],
                produtos: [],
                descontos: [],
                pedidos: []
            },
            
            // Define all Desktop Application modules config
            modules: {
                clientes: {
                    title: 'Clientes',
                    colorClass: 'bg-indigo-600',
                    textColorClass: 'text-indigo-400',
                    svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>`,
                    apiEndpoint: '/api/clientes',
                    columns: [
                        { label: 'Nome', key: 'nome' },
                        { label: 'E-mail', key: 'email', fallback: '—' },
                        { label: 'Telefone', key: 'telefone', fallback: '—' },
                        { label: 'Status', key: 'status', render: val => `<span class="px-2 py-0.5 text-xs font-semibold rounded-full ${val === 'ativo' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'}">${val.toUpperCase()}</span>` }
                    ],
                    fields: [
                        { label: 'Nome', name: 'nome', type: 'text', required: true },
                        { label: 'E-mail', name: 'email', type: 'email', required: false },
                        { label: 'Telefone', name: 'telefone', type: 'text', placeholder: '(XX) XXXXX-XXXX', required: false },
                        { label: 'Endereço', name: 'endereco', type: 'text', required: false },
                        { label: 'Cidade', name: 'cidade', type: 'text', required: false },
                        { label: 'Estado', name: 'estado', type: 'text', maxLength: 2, required: false },
                        { label: 'CEP', name: 'cep', type: 'text', placeholder: 'XXXXX-XXX', required: false },
                        { label: 'Status', name: 'status', type: 'select', options: [{value: 'ativo', label: 'Ativo'}, {value: 'inativo', label: 'Inativo'}], required: true }
                    ]
                },
                produtos: {
                    title: 'Produtos',
                    colorClass: 'bg-teal-600',
                    textColorClass: 'text-teal-400',
                    svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>`,
                    apiEndpoint: '/api/produtos',
                    columns: [
                        { label: 'Nome', key: 'nome' },
                        { label: 'SKU', key: 'sku' },
                        { label: 'Preço', key: 'preco', render: val => DesktopApp.formatCurrency(val) },
                        { label: 'Categoria', key: 'categoria' },
                        { label: 'Status', key: 'status', render: val => `<span class="px-2 py-0.5 text-xs font-semibold rounded-full ${val === 'ativo' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'}">${val.toUpperCase()}</span>` }
                    ],
                    fields: [
                        { label: 'Nome do Produto', name: 'nome', type: 'text', required: true },
                        { label: 'SKU', name: 'sku', type: 'text', required: true },
                        { label: 'Preço Padrão (R$)', name: 'preco', type: 'number', step: '0.01', required: true },
                        { label: 'Descrição', name: 'descricao', type: 'textarea', required: true },
                        { label: 'Categoria', name: 'categoria', type: 'text', required: true },
                        { label: 'Subcategoria', name: 'subcategoria', type: 'text', required: true },
                        { label: 'Marca', name: 'marca', type: 'text', required: true },
                        { label: 'Modelo', name: 'modelo', type: 'text', required: true },
                        { label: 'Cor', name: 'cor', type: 'text', required: true },
                        { label: 'Tamanho', name: 'tamanho', type: 'text', required: true },
                        { label: 'Material', name: 'material', type: 'text', required: true },
                        { label: 'Tipo', name: 'tipo', type: 'text', required: true },
                        { label: 'Tags (separadas por vírgula)', name: 'tags', type: 'text', required: false },
                        { label: 'Imagem (Nome do Arquivo)', name: 'imagem', type: 'text', required: true, default: 'produto.jpg' },
                        { label: 'Status', name: 'status', type: 'select', options: [{value: 'ativo', label: 'Ativo'}, {value: 'inativo', label: 'Inativo'}], required: true }
                    ]
                },
                descontos: {
                    title: 'Descontos',
                    colorClass: 'bg-rose-600',
                    textColorClass: 'text-rose-400',
                    svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>`,
                    apiEndpoint: '/api/descontos',
                    columns: [
                        { label: 'Nome', key: 'nome' },
                        { label: 'Percentual', key: 'percentual', render: val => `${parseFloat(val).toFixed(2).replace('.', ',')}%` },
                        { label: 'Situação', key: 'situacao', render: val => `<span class="px-2 py-0.5 text-xs font-semibold rounded-full ${val === 'ativo' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'}">${(val || 'ativo').toUpperCase()}</span>` }
                    ],
                    fields: [
                        { label: 'Nome do Desconto', name: 'nome', type: 'text', required: true },
                        { label: 'Percentual (%)', name: 'percentual', type: 'number', step: '0.01', min: 0, max: 100, required: true },
                        { label: 'Descrição', name: 'descricao', type: 'textarea', required: false },
                        { label: 'Situação', name: 'situacao', type: 'select', options: [{value: 'ativo', label: 'Ativo'}, {value: 'inativo', label: 'Inativo'}], required: true }
                    ]
                },
                promocoes: {
                    title: 'Promoções',
                    colorClass: 'bg-amber-600',
                    textColorClass: 'text-amber-400',
                    svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" /></svg>`,
                    apiEndpoint: '/api/promocoes',
                    columns: [
                        { label: 'Nome', key: 'nome' },
                        { label: 'Percentual', key: 'percentual', render: val => `${parseFloat(val).toFixed(2).replace('.', ',')}%` },
                        { label: 'Início', key: 'data_inicio', render: val => DesktopApp.formatDate(val) },
                        { label: 'Fim', key: 'data_fim', render: val => DesktopApp.formatDate(val) },
                        { label: 'Situação', key: 'situacao', render: val => `<span class="px-2 py-0.5 text-xs font-semibold rounded-full ${val === 'ativo' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'}">${(val || 'ativo').toUpperCase()}</span>` }
                    ],
                    fields: [
                        { label: 'Nome da Promoção', name: 'nome', type: 'text', required: true },
                        { label: 'Percentual de Desconto (%)', name: 'percentual', type: 'number', step: '0.01', min: 0, max: 100, required: true },
                        { label: 'Data de Início', name: 'data_inicio', type: 'date', required: true },
                        { label: 'Data de Fim', name: 'data_fim', type: 'date', required: true },
                        { label: 'Descrição', name: 'descricao', type: 'textarea', required: false },
                        { label: 'Situação', name: 'situacao', type: 'select', options: [{value: 'ativo', label: 'Ativo'}, {value: 'inativo', label: 'Inativo'}], required: true }
                    ]
                },
                precos: {
                    title: 'Preços',
                    colorClass: 'bg-emerald-600',
                    textColorClass: 'text-emerald-400',
                    svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V5" /></svg>`,
                    apiEndpoint: '/api/precos',
                    columns: [
                        { label: 'Produto', key: 'produto_id', render: val => DesktopApp.getCachedName('produtos', val) },
                        { label: 'Desconto Relacionado', key: 'desconto_id', render: val => val ? DesktopApp.getCachedName('descontos', val) : 'Nenhum' },
                        { label: 'Preço Venda', key: 'preco', render: val => DesktopApp.formatCurrency(val) },
                        { label: 'Unidade de Medida', key: 'medida' },
                        { label: 'Situação', key: 'situacao', render: val => `<span class="px-2 py-0.5 text-xs font-semibold rounded-full ${val === 'ativo' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800'}">${(val || 'ativo').toUpperCase()}</span>` }
                    ],
                    fields: [
                        { label: 'Produto', name: 'produto_id', type: 'select', cacheResource: 'produtos', required: true },
                        { label: 'Desconto Associado', name: 'desconto_id', type: 'select', cacheResource: 'descontos', required: false, nullable: true },
                        { label: 'Preço (R$)', name: 'preco', type: 'number', step: '0.01', required: true },
                        { label: 'Medida', name: 'medida', type: 'text', default: 'unidade', required: true },
                        { label: 'Situação', name: 'situacao', type: 'select', options: [{value: 'ativo', label: 'Ativo'}, {value: 'inativo', label: 'Inativo'}], required: true }
                    ]
                },
                pedidos: {
                    title: 'Pedidos',
                    colorClass: 'bg-blue-600',
                    textColorClass: 'text-blue-400',
                    svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>`,
                    apiEndpoint: '/api/pedidos',
                    columns: [
                        { label: 'Código Pedido', key: 'codigo_pedido' },
                        { label: 'Cliente', key: 'cliente_id', render: val => DesktopApp.getCachedName('clientes', val) },
                        { label: 'Produto', key: 'produto_id', render: val => DesktopApp.getCachedName('produtos', val) },
                        { label: 'Situação', key: 'situacao', render: val => {
                            let badge = 'bg-gray-100 text-gray-800';
                            if (val === 'entregue') badge = 'bg-emerald-100 text-emerald-800';
                            if (val === 'processando') badge = 'bg-blue-100 text-blue-800';
                            if (val === 'pendente') badge = 'bg-amber-100 text-amber-800';
                            if (val === 'cancelado') badge = 'bg-rose-100 text-rose-800';
                            return `<span class="px-2 py-0.5 text-xs font-semibold rounded-full ${badge}">${(val || 'pendente').toUpperCase()}</span>`;
                        }}
                    ],
                    fields: [
                        { label: 'Código do Pedido', name: 'codigo_pedido', type: 'text', required: true, default: () => 'PED-' + new Date().getFullYear() + '-' + Math.floor(Math.random() * 9000 + 1000) },
                        { label: 'Cliente', name: 'cliente_id', type: 'select', cacheResource: 'clientes', required: true },
                        { label: 'Produto', name: 'produto_id', type: 'select', cacheResource: 'produtos', required: true },
                        { label: 'Situação', name: 'situacao', type: 'select', options: [{value: 'pendente', label: 'Pendente'}, {value: 'processando', label: 'Processando'}, {value: 'entregue', label: 'Entregue'}, {value: 'cancelado', label: 'Cancelado'}], required: true }
                    ]
                },
                pagamentos: {
                    title: 'Pagamentos',
                    colorClass: 'bg-purple-600',
                    textColorClass: 'text-purple-400',
                    svgIcon: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>`,
                    apiEndpoint: '/api/pagamentos',
                    columns: [
                        { label: 'Pedido', key: 'pedido_id', render: val => DesktopApp.getCachedName('pedidos', val) },
                        { label: 'Cliente', key: 'cliente_id', render: val => DesktopApp.getCachedName('clientes', val) },
                        { label: 'Valor', key: 'valor', render: val => DesktopApp.formatCurrency(val) },
                        { label: 'Tipo', key: 'tipo', render: val => val ? val.toUpperCase() : 'PIX' },
                        { label: 'Previsto', key: 'data_estimada_pagamento', render: val => DesktopApp.formatDate(val) },
                        { label: 'Situação', key: 'situacao', render: val => {
                            let badge = 'bg-gray-100 text-gray-800';
                            if (val === 'pago') badge = 'bg-emerald-100 text-emerald-800';
                            if (val === 'processando') badge = 'bg-blue-100 text-blue-800';
                            if (val === 'pendente') badge = 'bg-amber-100 text-amber-800';
                            if (val === 'cancelado') badge = 'bg-slate-200 text-slate-700';
                            if (val === 'estornado') badge = 'bg-rose-100 text-rose-800';
                            return `<span class="px-2 py-0.5 text-xs font-semibold rounded-full ${badge}">${(val || 'pendente').toUpperCase()}</span>`;
                        }}
                    ],
                    fields: [
                        { label: 'Cliente', name: 'cliente_id', type: 'select', cacheResource: 'clientes', required: true },
                        { label: 'Pedido Associado', name: 'pedido_id', type: 'select', cacheResource: 'pedidos', required: true },
                        { label: 'Valor (R$)', name: 'valor', type: 'number', step: '0.01', required: true },
                        { label: 'Tipo de Pagamento', name: 'tipo', type: 'select', options: [{value: 'pix', label: 'PIX'}, {value: 'boleto', label: 'Boleto'}, {value: 'cartao_credito', label: 'Cartão de Crédito'}, {value: 'dinheiro', label: 'Dinheiro'}], required: true, default: 'pix' },
                        { label: 'Data Estimada de Pagamento', name: 'data_estimada_pagamento', type: 'date', required: true, default: () => new Date().toISOString().substring(0, 10) },
                        { label: 'Data Efetiva do Pagamento', name: 'data_evetiva_pagamento', type: 'date', required: false },
                        { label: 'Comprovante / Evidência', name: 'evidencia', type: 'file', accept: 'image/*,application/pdf', required: false },
                        { label: 'Situação', name: 'situacao', type: 'select', options: [{value: 'pendente', label: 'Pendente'}, {value: 'processando', label: 'Processando'}, {value: 'pago', label: 'Pago'}, {value: 'estornado', label: 'Estornado'}], required: true },
                        { label: 'Observações', name: 'observacoes', type: 'textarea', required: false }
                    ]
                }
            },

            // Initialization
            init() {
                this.setupShortcuts();
                this.setupTaskbarClock();
                this.setupEventListeners();
                this.loadCache();
                
                // Read query param or activeApp from Laravel context
                const activeApp = "{{ $activeApp }}";
                if (activeApp && this.modules[activeApp]) {
                    setTimeout(() => {
                        this.openWindow(activeApp);
                    }, 500);
                }
            },

            // Set up Desktop Shortcuts UI
            setupShortcuts() {
                const container = document.getElementById('desktop-shortcuts');
                container.innerHTML = '';
                
                Object.keys(this.modules).forEach(key => {
                    const mod = this.modules[key];
                    const shortcut = document.createElement('div');
                    shortcut.className = 'w-20 flex flex-col items-center justify-center p-2 text-center text-white ext-shortcut cursor-pointer transition-all select-none gap-1';
                    shortcut.dataset.module = key;
                    shortcut.innerHTML = `
                        <div class="w-12 h-12 rounded-lg ${mod.colorClass} shadow-lg flex items-center justify-center border border-white/10 text-white">
                            ${mod.svgIcon}
                        </div>
                        <span class="text-xs font-outfit font-medium text-slate-100 drop-shadow-md select-none">${mod.title}</span>
                    `;
                    
                    // Double click opens, single click selects
                    shortcut.addEventListener('click', (e) => {
                        e.stopPropagation();
                        if (this.activeShortcut) {
                            this.activeShortcut.classList.remove('active');
                        }
                        shortcut.classList.add('active');
                        this.activeShortcut = shortcut;
                    });

                    shortcut.addEventListener('dblclick', () => {
                        this.openWindow(key);
                    });

                    container.appendChild(shortcut);
                });
            },

            // Realtime Tray Clock and Date Update
            setupTaskbarClock() {
                const updateTime = () => {
                    const date = new Date();
                    const timeString = date.toLocaleTimeString('pt-BR');
                    const dateString = date.toLocaleDateString('pt-BR');
                    document.getElementById('tray-time').textContent = timeString;
                    document.getElementById('tray-date').textContent = dateString;
                };
                updateTime();
                setInterval(updateTime, 1000);
            },

            // Load static resources list in memory to feed dropdowns
            async loadCache() {
                try {
                    const resources = ['clientes', 'produtos', 'descontos', 'pedidos'];
                    for (const res of resources) {
                        const url = res === 'pedidos' ? '/api/pedidos' : `/api/${res}`;
                        const response = await fetch(url);
                        if (response.ok) {
                            this.cache[res] = await response.json();
                        }
                    }
                    // Refresh open windows forms options if active
                    Object.keys(this.openWindows).forEach(winId => {
                        const win = this.openWindows[winId];
                        if (win.formOpen) {
                            this.renderDropdownsInForm(winId);
                        }
                    });
                } catch (e) {
                    console.error('Error loading resources cache:', e);
                }
            },

            // Helper to get name from cached resource
            getCachedName(resource, id) {
                if (!id) return '—';
                const items = this.cache[resource] || [];
                const found = items.find(item => item.id == id);
                if (found) {
                    return found.nome || found.codigo_pedido || found.id;
                }
                return `ID: ${id}`;
            },

            // Global event listeners (clicks outside menus, dragging)
            setupEventListeners() {
                // Click Desktop background to deselect shortcuts and close menus
                document.body.addEventListener('click', (e) => {
                    if (this.activeShortcut) {
                        this.activeShortcut.classList.remove('active');
                        this.activeShortcut = null;
                    }
                    const startMenu = document.getElementById('start-menu');
                    if (!startMenu.classList.contains('hidden') && !e.target.closest('#start-btn') && !e.target.closest('#start-menu')) {
                        startMenu.classList.add('hidden');
                    }
                });

                // Start Menu Toggle
                document.getElementById('start-btn').addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.toggleStartMenu();
                });

                // Dragging Support
                let isDragging = false;
                let dragElement = null;
                let startX, startY;
                let initialX, initialY;

                document.addEventListener('mousedown', (e) => {
                    const header = e.target.closest('.ext-window-header');
                    if (header) {
                        const win = header.closest('.ext-window');
                        if (win && !e.target.closest('button')) {
                            const winId = win.dataset.id;
                            this.focusWindow(winId);

                            isDragging = true;
                            dragElement = win;
                            startX = e.clientX;
                            startY = e.clientY;
                            initialX = dragElement.offsetLeft;
                            initialY = dragElement.offsetTop;
                            dragElement.classList.add('select-none');
                        }
                    }
                });

                document.addEventListener('mousemove', (e) => {
                    if (isDragging && dragElement) {
                        const dx = e.clientX - startX;
                        const dy = e.clientY - startY;
                        
                        // Bound layout check
                        let newLeft = initialX + dx;
                        let newTop = initialY + dy;
                        if (newTop < 0) newTop = 0;
                        if (newTop > window.innerHeight - 80) newTop = window.innerHeight - 80;

                        dragElement.style.left = `${newLeft}px`;
                        dragElement.style.top = `${newTop}px`;
                    }
                });

                document.addEventListener('mouseup', () => {
                    if (isDragging && dragElement) {
                        dragElement.classList.remove('select-none');
                        isDragging = false;
                        dragElement = null;
                    }
                });
            },

            toggleStartMenu() {
                const startMenu = document.getElementById('start-menu');
                startMenu.classList.toggle('hidden');
            },

            // Open Window System
            openWindow(winId) {
                if (this.openWindows[winId]) {
                    // Window already exists, just restore and focus
                    const winObj = this.openWindows[winId];
                    if (winObj.minimized) {
                        this.restoreWindow(winId);
                    } else {
                        this.focusWindow(winId);
                    }
                    return;
                }

                const mod = this.modules[winId];
                if (!mod) return;

                // Create absolute window div
                const win = document.createElement('div');
                win.id = `win-${winId}`;
                win.dataset.id = winId;
                // Cascading default position
                const indexOffset = Object.keys(this.openWindows).length * 24;
                win.className = 'absolute bg-white rounded-lg flex flex-col ext-window overflow-hidden z-[100] border border-slate-300 pointer-events-auto shadow-2xl';
                win.style.width = '820px';
                win.style.height = '520px';
                win.style.left = `${100 + indexOffset}px`;
                win.style.top = `${60 + indexOffset}px`;

                // Window Inner HTML template (Toolbar, Data Grid, Modals)
                win.innerHTML = `
                    <!-- Header -->
                    <div class="h-10 flex items-center justify-between px-3 text-white select-none ext-window-header transition-all">
                        <div class="flex items-center gap-2 text-sm font-semibold font-outfit">
                            <span class="${mod.textColorClass}">${mod.svgIcon}</span>
                            <span class="tracking-wide">${mod.title}</span>
                        </div>
                        <div class="flex items-center gap-1.5 no-drag">
                            <button title="Minimizar" onclick="DesktopApp.minimizeWindow('${winId}')" class="p-1 rounded hover:bg-white/20 active:bg-white/30 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" /></svg>
                            </button>
                            <button title="Maximizar" onclick="DesktopApp.maximizeWindow('${winId}')" class="p-1 rounded hover:bg-white/20 active:bg-white/30 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4z" /></svg>
                            </button>
                            <button title="Fechar" onclick="DesktopApp.closeWindow('${winId}')" class="p-1 rounded hover:bg-rose-600 active:bg-rose-700 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Toolbar -->
                    <div class="h-11 bg-slate-50 border-b border-slate-200 flex items-center justify-between px-3">
                        <div class="flex items-center gap-1">
                            <button onclick="DesktopApp.showForm('${winId}')" class="flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-blue-50 text-blue-700 hover:bg-blue-100 transition-all border border-blue-200/50 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                <span>Novo</span>
                            </button>
                            <button id="btn-edit-${winId}" disabled onclick="DesktopApp.editSelected('${winId}')" class="flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                <span>Editar</span>
                            </button>
                            <button id="btn-delete-${winId}" disabled onclick="DesktopApp.deleteSelected('${winId}')" class="flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                <span>${mod.apiEndpoint === '/api/pagamentos' ? 'Cancelar' : 'Excluir'}</span>
                            </button>
                            <div class="h-5 w-px bg-slate-200 mx-1"></div>
                            <button onclick="DesktopApp.refreshGrid('${winId}')" class="flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded text-slate-600 hover:bg-slate-100 transition-all border border-transparent cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18" /></svg>
                                <span>Atualizar</span>
                            </button>
                        </div>
                        <div class="flex items-center gap-2">
                            ${mod.fields.some(field => field.name === 'situacao') ? `
                                ${(() => {
                                    const selectedFilter = this.openWindows[winId]?.situacaoFilter || '';
                                    const situacaoField = mod.fields.find(field => field.name === 'situacao');
                                    const filterOptions = [...(situacaoField?.options || [])];

                                    if (mod.apiEndpoint === '/api/pagamentos') {
                                        filterOptions.push({ value: 'excluido', label: 'Excluído' });
                                    }

                                    return `
                                <div class="relative w-40">
                                    <select onchange="DesktopApp.filterBySituacao('${winId}', this.value)" class="w-full appearance-none pl-2.5 pr-8 py-1 text-xs bg-white border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">
                                        <option value="">Todas as situações</option>
                                        ${filterOptions.map(option => `<option value="${option.value}" ${String(option.value) === String(selectedFilter) ? 'selected' : ''}>${option.label}</option>`).join('')}
                                    </select>
                                    <span class="absolute inset-y-0 right-0 pr-2 flex items-center text-slate-400 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                                    </span>
                                </div>
                                    `;
                                })()}
                            ` : ''}
                            <div class="relative w-48">
                                <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center text-slate-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </span>
                                <input type="text" placeholder="Buscar..." oninput="DesktopApp.filterGrid('${winId}', this.value)" class="w-full pl-8 pr-2.5 py-1 text-xs bg-white border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">
                            </div>
                        </div>
                    </div>

                    <!-- Main Grid Area -->
                    <div class="flex-1 overflow-auto ext-scrollbar relative bg-slate-50" id="grid-container-${winId}">
                        <!-- Data table is loaded here -->
                        <div class="flex items-center justify-center h-full text-slate-400 gap-2">
                            <span class="w-4 h-4 rounded-full border-2 border-slate-300 border-t-blue-500 animate-spin"></span>
                            <span class="text-xs">Carregando dados...</span>
                        </div>
                    </div>

                    <!-- Pagination Footer -->
                    <div class="h-9 bg-slate-100 border-t border-slate-200 flex items-center justify-between px-3 text-xs text-slate-600">
                        <div class="flex items-center gap-1.5">
                            <button id="p-prev-${winId}" onclick="DesktopApp.prevPage('${winId}')" class="p-1 rounded hover:bg-slate-200 active:bg-slate-300 text-slate-600 disabled:text-slate-300 disabled:hover:bg-transparent cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                            <span id="p-info-${winId}">Pág. 1 de 1</span>
                            <button id="p-next-${winId}" onclick="DesktopApp.nextPage('${winId}')" class="p-1 rounded hover:bg-slate-200 active:bg-slate-300 text-slate-600 disabled:text-slate-300 disabled:hover:bg-transparent cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </div>
                        <span id="p-count-${winId}">Carregando totalizadores...</span>
                    </div>

                    <!-- Dynamic Form Panel Drawer (Hidden by default) -->
                    <div id="form-drawer-${winId}" class="absolute inset-x-0 bottom-9 top-10 bg-slate-900/40 backdrop-blur-xs hidden justify-end z-[50] pointer-events-auto">
                        <div class="w-[360px] bg-white h-full shadow-2xl border-l border-slate-200 flex flex-col transform translate-x-full transition-transform duration-200 ease-out" id="form-content-${winId}">
                            <!-- Form Header -->
                            <div class="h-11 border-b border-slate-100 flex items-center justify-between px-4 bg-slate-50">
                                <h3 class="text-sm font-semibold font-outfit text-slate-800" id="form-title-${winId}">Formulário</h3>
                                <button onclick="DesktopApp.hideForm('${winId}')" class="p-1.5 rounded hover:bg-slate-200 active:bg-slate-300 text-slate-500 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            
                            <!-- Form Fields Container -->
                            <form id="form-fields-${winId}" onsubmit="DesktopApp.handleFormSubmit(event, '${winId}')" class="flex-1 overflow-auto p-4 space-y-4 ext-scrollbar select-text text-slate-700">
                                <!-- Fields dynamically added here -->
                            </form>

                            <!-- Form Actions -->
                            <div class="h-14 border-t border-slate-100 bg-slate-50 flex items-center justify-end px-4 gap-2">
                                <button type="button" onclick="DesktopApp.hideForm('${winId}')" class="text-xs font-semibold px-4 py-2 border border-slate-200 hover:bg-slate-100 rounded text-slate-600 transition-all cursor-pointer">Cancelar</button>
                                <button type="submit" form="form-fields-${winId}" class="text-xs font-semibold px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded shadow-sm transition-all cursor-pointer">Salvar</button>
                            </div>
                        </div>
                    </div>

                `;

                document.getElementById('windows-container').appendChild(win);

                // Initialize Window state
                this.openWindows[winId] = {
                    element: win,
                    minimized: false,
                    maximized: false,
                    selectedId: null,
                    searchTerm: '',
                    currentPage: 1,
                    itemsPerPage: 10,
                    data: [],
                    formOpen: false,
                    formMode: 'create', // or 'edit'
                    situacaoFilter: '',
                };

                // Add to taskbar
                this.addTaskToTaskbar(winId);

                // Load Data
                this.refreshGrid(winId);

                // Focus on open
                this.focusWindow(winId);
                
                // Update Address Bar smoothly
                history.pushState(null, '', `/${winId === 'desktop' ? '' : winId}`);
            },

            isDetailWindow(winId) {
                return String(winId).startsWith('detail-');
            },

            // Focus on a Window (elevate z-index)
            focusWindow(winId) {
                if (this.activeWindowId) {
                    const prevWin = document.getElementById(`win-${this.activeWindowId}`);
                    const prevTask = document.getElementById(`task-${this.activeWindowId}`);
                    if (prevWin) {
                        prevWin.querySelector('.ext-window-header').className = 'h-10 flex items-center justify-between px-3 text-white select-none ext-window-header ext-window-header-inactive';
                    }
                    if (prevTask) {
                        prevTask.className = 'h-8 px-3 rounded flex items-center gap-1.5 text-xs text-slate-400 bg-slate-800/40 hover:bg-slate-800/60 transition-all border border-slate-700/30 cursor-pointer max-w-[140px] truncate';
                    }
                }

                const winObj = this.openWindows[winId];
                if (!winObj) return;

                this.windowZIndex += 1;
                winObj.element.style.zIndex = this.windowZIndex;
                winObj.element.querySelector('.ext-window-header').className = 'h-10 flex items-center justify-between px-3 text-white select-none ext-window-header ext-window-header-active';

                const task = document.getElementById(`task-${winId}`);
                if (task) {
                    task.className = 'h-8 px-3 rounded flex items-center gap-1.5 text-xs text-white bg-slate-700 border border-slate-600 transition-all font-semibold cursor-pointer max-w-[140px] truncate';
                }

                this.activeWindowId = winId;
                
                // Update address bar path for primary app windows only
                if (!this.isDetailWindow(winId) && window.location.pathname !== `/${winId}`) {
                    history.pushState(null, '', `/${winId}`);
                }
            },

            // Minimize Window (Slide out)
            minimizeWindow(winId) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                winObj.element.classList.add('minimized');
                winObj.minimized = true;

                // De-activate in taskbar
                const task = document.getElementById(`task-${winId}`);
                if (task) {
                    task.className = 'h-8 px-3 rounded flex items-center gap-1.5 text-xs text-slate-400 bg-slate-800/40 hover:bg-slate-800/60 transition-all border border-slate-700/30 cursor-pointer max-w-[140px] truncate';
                }

                // Focus on another window if available
                const remaining = Object.keys(this.openWindows).filter(k => k !== winId && !this.openWindows[k].minimized);
                if (remaining.length > 0) {
                    this.focusWindow(remaining[remaining.length - 1]);
                } else if (!this.isDetailWindow(winId)) {
                    this.activeWindowId = null;
                    history.pushState(null, '', '/');
                }
            },

            // Restore from Minimized
            restoreWindow(winId) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                winObj.element.classList.remove('minimized');
                winObj.minimized = false;
                this.focusWindow(winId);
            },

            // Maximize / Toggle full height
            maximizeWindow(winId) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                if (winObj.maximized) {
                    // Restore dimensions
                    winObj.element.style.width = '820px';
                    winObj.element.style.height = '520px';
                    winObj.element.style.left = winObj.restoreLeft || '100px';
                    winObj.element.style.top = winObj.restoreTop || '60px';
                    winObj.element.style.borderRadius = '0.5rem';
                    winObj.maximized = false;
                } else {
                    // Cache old dimensions
                    winObj.restoreLeft = winObj.element.style.left;
                    winObj.restoreTop = winObj.element.style.top;
                    
                    // Set full sizes
                    winObj.element.style.width = '100vw';
                    winObj.element.style.height = 'calc(100vh - 48px)';
                    winObj.element.style.left = '0';
                    winObj.element.style.top = '0';
                    winObj.element.style.borderRadius = '0';
                    winObj.maximized = true;
                }
            },

            // Close Window
            closeWindow(winId) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                winObj.element.remove();
                delete this.openWindows[winId];

                if (this.isDetailWindow(winId)) {
                    delete this.modules[winId];
                }

                // Remove taskbar button
                const task = document.getElementById(`task-${winId}`);
                if (task) task.remove();

                // Focus another
                const remaining = Object.keys(this.openWindows).filter(k => !this.openWindows[k].minimized);
                if (remaining.length > 0) {
                    this.focusWindow(remaining[remaining.length - 1]);
                } else if (!this.isDetailWindow(winId)) {
                    this.activeWindowId = null;
                    history.pushState(null, '', '/');
                }
            },

            // Add Task button to Taskbar
            addTaskToTaskbar(winId) {
                const mod = this.modules[winId];
                const container = document.getElementById('taskbar-tasks');

                const task = document.createElement('div');
                task.id = `task-${winId}`;
                task.className = 'h-8 px-3 rounded flex items-center gap-1.5 text-xs text-slate-400 bg-slate-800/40 hover:bg-slate-800/60 transition-all border border-slate-700/30 cursor-pointer max-w-[140px] truncate';
                task.innerHTML = `
                    <span class="${mod.textColorClass}">${mod.svgIcon}</span>
                    <span class="font-outfit truncate">${mod.title}</span>
                `;

                task.addEventListener('click', () => {
                    const winObj = this.openWindows[winId];
                    if (!winObj) return;

                    if (winObj.minimized) {
                        this.restoreWindow(winId);
                    } else if (this.activeWindowId === winId) {
                        this.minimizeWindow(winId);
                    } else {
                        this.focusWindow(winId);
                    }
                });

                container.appendChild(task);
            },

            // Refresh Data Grid (Fetch List API)
            async refreshGrid(winId) {
                const winObj = this.openWindows[winId];
                const mod = this.modules[winId];
                if (!winObj || !mod) return;

                const gridContainer = document.getElementById(`grid-container-${winId}`);
                gridContainer.innerHTML = `
                    <div class="flex items-center justify-center h-full text-slate-400 gap-2">
                        <span class="w-4 h-4 rounded-full border-2 border-slate-300 border-t-blue-500 animate-spin"></span>
                        <span class="text-xs">Atualizando registros...</span>
                    </div>
                `;

                // Reset Row selections
                winObj.selectedId = null;
                this.updateToolbarButtons(winId);

                try {
                    const response = await fetch(mod.apiEndpoint);
                    if (!response.ok) throw new Error('API request failed');
                    
                    const data = await response.json();
                    winObj.data = data;
                    
                    this.renderGrid(winId);
                } catch (error) {
                    console.error('Error fetching list data:', error);
                    gridContainer.innerHTML = `
                        <div class="flex flex-col items-center justify-center h-full text-slate-400 p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-rose-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            <span class="text-xs font-semibold text-rose-700">Erro ao carregar dados do servidor</span>
                            <button onclick="DesktopApp.refreshGrid('${winId}')" class="mt-3 text-xs bg-slate-200 hover:bg-slate-300 text-slate-700 px-3 py-1.5 rounded transition-all cursor-pointer">Tentar Novamente</button>
                        </div>
                    `;
                }
            },

            // Render table grid based on cached state
            renderGrid(winId) {
                const winObj = this.openWindows[winId];
                const mod = this.modules[winId];
                if (!winObj || !mod) return;

                const gridContainer = document.getElementById(`grid-container-${winId}`);
                
                // 1. Filter Data
                let filteredData = winObj.data;
                if (winObj.situacaoFilter) {
                    filteredData = filteredData.filter(row => {
                        if (winObj.situacaoFilter === 'excluido') {
                            return Boolean(row.deleted_at);
                        }

                        return String(row.situacao || '') === String(winObj.situacaoFilter);
                    });
                }
                if (winObj.searchTerm) {
                    const search = winObj.searchTerm.toLowerCase();
                    filteredData = filteredData.filter(row => {
                        return Object.keys(row).some(key => {
                            const val = row[key];
                            if (val === null || val === undefined) return false;
                            
                            // If key points to cache ids, lookup cache value
                            if (key === 'cliente_id') return this.getCachedName('clientes', val).toLowerCase().includes(search);
                            if (key === 'produto_id') return this.getCachedName('produtos', val).toLowerCase().includes(search);
                            if (key === 'desconto_id') return this.getCachedName('descontos', val).toLowerCase().includes(search);
                            if (key === 'pedido_id') return this.getCachedName('pedidos', val).toLowerCase().includes(search);

                            return String(val).toLowerCase().includes(search);
                        });
                    });
                }

                // 2. Pagination Calculations
                const totalItems = filteredData.length;
                const totalPages = Math.max(1, Math.ceil(totalItems / winObj.itemsPerPage));
                if (winObj.currentPage > totalPages) winObj.currentPage = totalPages;

                const startIndex = (winObj.currentPage - 1) * winObj.itemsPerPage;
                const paginatedData = filteredData.slice(startIndex, startIndex + winObj.itemsPerPage);

                // Render Footer Stats
                document.getElementById(`p-info-${winId}`).textContent = `Pág. ${winObj.currentPage} de ${totalPages}`;
                document.getElementById(`p-count-${winId}`).textContent = totalItems === 0 
                    ? 'Nenhum registro encontrado' 
                    : `Exibindo ${startIndex + 1} a ${Math.min(startIndex + winObj.itemsPerPage, totalItems)} de ${totalItems} registros`;

                document.getElementById(`p-prev-${winId}`).disabled = winObj.currentPage === 1;
                document.getElementById(`p-next-${winId}`).disabled = winObj.currentPage === totalPages;

                if (totalItems === 0) {
                    gridContainer.innerHTML = `
                        <div class="flex flex-col items-center justify-center h-full text-slate-400 select-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                            <span class="text-xs">Nenhum registro correspondente cadastrado.</span>
                        </div>
                    `;
                    return;
                }

                // Render Spreadsheet styled table
                let tableHTML = `
                    <table class="w-full text-left text-xs border-collapse select-text">
                        <thead class="sticky top-0 z-30 ext-grid-header shadow-xs">
                            <tr>
                                <th class="w-10 px-3 py-2 text-center text-slate-500 font-semibold border-r border-b border-slate-200">#</th>
                                ${mod.columns.map(col => `<th class="px-4 py-2 text-slate-600 font-semibold border-r border-b border-slate-200">${col.label}</th>`).join('')}
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            ${paginatedData.map((row, index) => {
                                const isSelected = winObj.selectedId == row.id;
                                return `
                                    <tr onclick="DesktopApp.selectRow('${winId}', ${row.id})" ondblclick="DesktopApp.openRecordDetails('${winId}', ${row.id})" class="ext-grid-row cursor-pointer transition-colors ${isSelected ? 'ext-grid-row-selected' : ''}" id="row-${winId}-${row.id}">
                                        <td class="px-3 py-2.5 text-center text-slate-400 font-mono ext-grid-cell">${startIndex + index + 1}</td>
                                        ${mod.columns.map(col => {
                                            const cellVal = row[col.key];
                                            const rendered = col.render ? col.render(cellVal, row) : (cellVal !== null && cellVal !== undefined ? cellVal : (col.fallback || ''));
                                            return `<td class="px-4 py-2.5 text-slate-700 ext-grid-cell truncate max-w-[200px]">${rendered}</td>`;
                                        }).join('')}
                                    </tr>
                                `;
                            }).join('')}
                        </tbody>
                    </table>
                `;

                gridContainer.innerHTML = tableHTML;
            },

            async openRecordDetails(winId, id) {
                const winObj = this.openWindows[winId];
                const mod = this.modules[winId];
                if (!winObj || !mod) return;

                if (winObj.selectedId && winObj.selectedId != id) {
                    const previousRow = document.getElementById(`row-${winId}-${winObj.selectedId}`);
                    if (previousRow) {
                        previousRow.classList.remove('ext-grid-row-selected');
                    }
                }

                winObj.selectedId = id;
                const selectedRow = document.getElementById(`row-${winId}-${id}`);
                if (selectedRow) {
                    selectedRow.classList.add('ext-grid-row-selected');
                }
                this.updateToolbarButtons(winId);
                this.hideForm(winId);

                const detailWindowId = `detail-${winId}`;
                const detailWindow = this.ensureDetailWindow(winId, id);
                const title = detailWindow?.querySelector('[data-detail-role="title"]');
                const body = detailWindow?.querySelector('[data-detail-role="body"]');

                if (!detailWindow || !title || !body) return;

                title.textContent = `Carregando ${mod.title.toLowerCase()}...`;
                body.innerHTML = `
                    <div class="flex items-center justify-center h-full min-h-[280px] text-slate-400 gap-2">
                        <span class="w-4 h-4 rounded-full border-2 border-slate-300 border-t-blue-500 animate-spin"></span>
                        <span class="text-xs">Buscando dados do item...</span>
                    </div>
                `;

                detailWindow.classList.remove('hidden');
                this.focusWindow(detailWindowId);

                try {
                    const response = await fetch(`${mod.apiEndpoint}/${id}`, {
                        headers: {
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        throw new Error('show request failed');
                    }

                    const record = await response.json();
                    winObj.detailRecord = record;
                    title.textContent = `${mod.title} #${record.id ?? id}`;
                    body.innerHTML = this.renderRecordDetails(winId, record);
                    this.syncDetailEditButtonState(winId, record);
                } catch (error) {
                    console.error('Error loading record details:', error);
                    title.textContent = `${mod.title} #${id}`;
                    body.innerHTML = `
                        <div class="flex flex-col items-center justify-center h-full min-h-[280px] text-slate-400 p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-rose-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            <span class="text-xs font-semibold text-rose-700">Não foi possível carregar os dados do item.</span>
                        </div>
                    `;
                }
            },

            ensureDetailWindow(winId, recordId) {
                const detailWindowId = `detail-${winId}`;
                const existingWindow = document.getElementById(`detail-window-${winId}`);
                if (existingWindow) {
                    return existingWindow;
                }

                const mod = this.modules[winId];
                const container = document.getElementById('windows-container');
                if (!mod || !container) return null;

                this.modules[detailWindowId] = {
                    title: `Detalhes de ${mod.title}`,
                    colorClass: mod.colorClass,
                    textColorClass: mod.textColorClass,
                    svgIcon: mod.svgIcon,
                    apiEndpoint: '',
                    columns: [],
                    fields: [],
                };

                const detailWindow = document.createElement('div');
                detailWindow.id = `detail-window-${winId}`;
                detailWindow.dataset.id = detailWindowId;
                detailWindow.className = 'hidden absolute bg-white rounded-lg flex flex-col ext-window overflow-hidden z-[150] border border-slate-300 pointer-events-auto shadow-2xl';
                detailWindow.style.width = '760px';
                detailWindow.style.height = '560px';
                detailWindow.style.left = 'calc(50% - 380px)';
                detailWindow.style.top = 'calc(50% - 280px)';

                detailWindow.innerHTML = `
                    <div class="h-10 flex items-center justify-between px-3 text-white select-none ext-window-header ext-window-header-active transition-all">
                        <div class="flex items-center gap-2 text-sm font-semibold font-outfit">
                            <span class="${mod.textColorClass}">${mod.svgIcon}</span>
                            <span class="tracking-wide">Detalhes de ${mod.title}</span>
                        </div>
                        <div class="flex items-center gap-1.5 no-drag">
                            <button title="Minimizar" onclick="DesktopApp.minimizeWindow('${detailWindowId}')" class="p-1 rounded hover:bg-white/20 active:bg-white/30 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" /></svg>
                            </button>
                            <button title="Maximizar" onclick="DesktopApp.maximizeWindow('${detailWindowId}')" class="p-1 rounded hover:bg-white/20 active:bg-white/30 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4z" /></svg>
                            </button>
                            <button title="Fechar" onclick="DesktopApp.closeWindow('${detailWindowId}')" class="p-1 rounded hover:bg-rose-600 active:bg-rose-700 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>
                    <div class="border-b border-slate-200 bg-slate-50 px-4 py-3 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-slate-400">Visualização</p>
                            <h3 class="text-sm font-semibold font-outfit text-slate-800" data-detail-role="title">Detalhes</h3>
                        </div>
                        <button id="detail-edit-button-${winId}" onclick="DesktopApp.editFromDetails('${winId}')" class="flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded bg-blue-600 hover:bg-blue-500 text-white transition-all cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            <span>Editar</span>
                        </button>
                    </div>
                    <div class="flex-1 overflow-auto p-4 text-slate-700 ext-scrollbar" data-detail-role="body"></div>
                `;

                container.appendChild(detailWindow);
                this.openWindows[detailWindowId] = {
                    element: detailWindow,
                    minimized: false,
                    maximized: false,
                    selectedId: recordId,
                    searchTerm: '',
                    currentPage: 1,
                    itemsPerPage: 10,
                    data: [],
                    formOpen: false,
                    formMode: 'detail',
                    sourceWindowId: winId,
                    detailRecord: null,
                };
                this.addTaskToTaskbar(detailWindowId);

                return detailWindow;
            },

            renderRecordDetails(winId, record) {
                const mod = this.modules[winId];
                if (!mod) return '';

                const fieldsHtml = mod.fields.map(field => {
                    const rawValue = record[field.name];
                    const relationKey = field.name.endsWith('_id') ? field.name.replace(/_id$/, '') : null;
                    const relatedRecord = relationKey ? record[relationKey] : null;
                    const displayValue = this.getDetailFieldDisplayValue(field, rawValue, relatedRecord, record);

                    if (field.type === 'file') {
                        return this.renderFileDetail(field, record, rawValue);
                    }

                    return `
                        <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-3">
                            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">${field.label}</p>
                            <div class="mt-2 text-sm font-medium text-slate-800 break-words">${displayValue}</div>
                        </div>
                    `;
                }).join('');

                const metadataHtml = `
                    <div class="rounded-lg border border-slate-200 bg-white p-4">
                        <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">Identificação</p>
                        <div class="mt-3 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-md bg-slate-50 px-3 py-2">
                                <p class="text-[11px] text-slate-400 uppercase tracking-wide">ID</p>
                                <p class="text-sm font-semibold text-slate-800">${record.id ?? '—'}</p>
                            </div>
                            <div class="rounded-md bg-slate-50 px-3 py-2">
                                <p class="text-[11px] text-slate-400 uppercase tracking-wide">UUID</p>
                                <p class="text-sm font-semibold text-slate-800 break-all">${record.uuid ?? '—'}</p>
                            </div>
                        </div>
                    </div>
                `;

                return `
                    <div class="space-y-4">
                        ${metadataHtml}
                        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                            ${fieldsHtml}
                        </div>
                    </div>
                `;
            },

            getDetailFieldDisplayValue(field, value, relatedRecord = null, record = {}) {
                if (value === null || value === undefined || value === '') {
                    return '<span class="text-slate-400">—</span>';
                }

                if (field.type === 'date') {
                    return this.formatDate(value);
                }

                if (field.type === 'number') {
                    return field.name === 'valor' ? this.formatCurrency(value) : String(value);
                }

                if (field.type === 'select') {
                    if (relatedRecord) {
                        return relatedRecord.nome || relatedRecord.codigo_pedido || relatedRecord.titulo || relatedRecord.id || value;
                    }

                    if (field.options && field.options.length > 0) {
                        const option = field.options.find(item => String(item.value) === String(value));
                        if (option) {
                            return option.label;
                        }
                    }

                    if (field.cacheResource) {
                        return this.getCachedName(field.cacheResource, value);
                    }
                }

                if (typeof value === 'object') {
                    return value.nome || value.codigo_pedido || value.id || '—';
                }

                return String(value);
            },

            renderFileDetail(field, record, value) {
                const filePath = record[`${field.name}_url`] || value;
                if (!filePath) {
                    return `
                        <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-3">
                            <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">${field.label}</p>
                            <div class="mt-2 text-sm font-medium text-slate-400">—</div>
                        </div>
                    `;
                }

                const isImage = record[`${field.name}_is_image`] ?? this.isImageFile(filePath);
                const fileUrl = record[`${field.name}_url`] || this.getFilePreviewUrl(filePath);
                const fileName = filePath.split('/').pop();

                return `
                    <div class="rounded-lg border border-slate-200 bg-slate-50/70 p-3 sm:col-span-2 xl:col-span-3">
                        <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-slate-400">${field.label}</p>
                        <div class="mt-3">
                            ${isImage ? `
                                <a href="${fileUrl}" target="_blank" rel="noopener noreferrer" class="block">
                                    <img src="${fileUrl}" alt="${field.label}" loading="lazy" class="w-full min-h-[240px] max-h-[420px] rounded-md border border-slate-200 object-contain bg-white cursor-zoom-in">
                                </a>
                            ` : `
                                <a href="${fileUrl}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-md border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-50 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828L18 9.828a4 4 0 10-5.657-5.657l-6.586 6.586a6 6 0 108.485 8.486L19.5 13" /></svg>
                                    <span>${fileName}</span>
                                </a>
                            `}
                        </div>
                    </div>
                `;
            },

            getFilePreviewUrl(filePath) {
                if (!filePath) return '';

                if (filePath.startsWith('http://') || filePath.startsWith('https://') || filePath.startsWith('/')) {
                    return filePath;
                }

                return `/storage/${filePath}`;
            },

            isImageFile(filePath) {
                if (!filePath) return false;

                return ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.bmp', '.svg']
                    .some(extension => filePath.toLowerCase().endsWith(extension));
            },

            isPaidPaymentRecord(winId, record = {}) {
                const mod = this.modules[winId];

                return mod?.apiEndpoint === '/api/pagamentos' && String(record.situacao || '').toLowerCase() === 'pago';
            },

            isCanceledPaymentRecord(winId, record = {}) {
                const mod = this.modules[winId];

                return mod?.apiEndpoint === '/api/pagamentos'
                    && String(record.situacao || '').toLowerCase() === 'cancelado'
                    && !record.deleted_at;
            },

            isDeletedPaymentRecord(winId, record = {}) {
                const mod = this.modules[winId];

                return mod?.apiEndpoint === '/api/pagamentos' && Boolean(record.deleted_at);
            },

            isLockedPaymentRecord(winId, record = {}) {
                return this.isPaidPaymentRecord(winId, record) || this.isDeletedPaymentRecord(winId, record);
            },

            syncDetailEditButtonState(winId, record = {}) {
                const editButton = document.getElementById(`detail-edit-button-${winId}`);
                if (!editButton) return;

                if (this.isLockedPaymentRecord(winId, record)) {
                    editButton.disabled = true;
                    editButton.title = 'Pagamento não pode ser editado';
                    editButton.classList.remove('bg-blue-600', 'hover:bg-blue-500', 'cursor-pointer');
                    editButton.classList.add('bg-slate-400', 'cursor-not-allowed', 'opacity-70');
                } else {
                    editButton.disabled = false;
                    editButton.title = 'Editar';
                    editButton.classList.remove('bg-slate-400', 'cursor-not-allowed', 'opacity-70');
                    editButton.classList.add('bg-blue-600', 'hover:bg-blue-500', 'cursor-pointer');
                }
            },

            hideDetails(winId) {
                this.closeWindow(`detail-${winId}`);
            },

            editFromDetails(winId) {
                const winObj = this.openWindows[`detail-${winId}`] || this.openWindows[winId];
                if (!winObj || !winObj.selectedId) return;

                if (this.isLockedPaymentRecord(winId, winObj.detailRecord || {})) {
                    return;
                }

                const sourceWinId = winObj.sourceWindowId || winId;
                this.openEditWindow(sourceWinId, winObj.selectedId);
                this.hideDetails(winId);
            },

            openEditWindow(sourceWinId, recordId) {
                const sourceWinObj = this.openWindows[sourceWinId];
                const sourceMod = this.modules[sourceWinId];
                if (!sourceWinObj || !sourceMod) return;

                const editWindowId = `edit-${sourceWinId}-${recordId}`;
                if (this.openWindows[editWindowId]) {
                    const existingEditWindow = this.openWindows[editWindowId];
                    if (existingEditWindow.minimized) {
                        this.restoreWindow(editWindowId);
                    } else {
                        this.focusWindow(editWindowId);
                    }
                    return;
                }

                const rowData = sourceWinObj.data.find(row => row.id == recordId) || {};
                if (this.isLockedPaymentRecord(sourceWinId, rowData)) {
                    return;
                }

                const mod = {
                    ...sourceMod,
                    title: `Editar ${sourceMod.title}`,
                };

                this.modules[editWindowId] = mod;

                const win = document.createElement('div');
                win.id = `win-${editWindowId}`;
                win.dataset.id = editWindowId;
                const indexOffset = Object.keys(this.openWindows).length * 24;
                win.className = 'absolute bg-white rounded-lg flex flex-col ext-window overflow-hidden z-[120] border border-slate-300 pointer-events-auto shadow-2xl';
                win.style.width = '760px';
                win.style.height = '560px';
                win.style.left = `${120 + indexOffset}px`;
                win.style.top = `${80 + indexOffset}px`;

                win.innerHTML = `
                    <div class="h-10 flex items-center justify-between px-3 text-white select-none ext-window-header transition-all">
                        <div class="flex items-center gap-2 text-sm font-semibold font-outfit">
                            <span class="${mod.textColorClass}">${mod.svgIcon}</span>
                            <span class="tracking-wide">Editar ${sourceMod.title}</span>
                        </div>
                        <div class="flex items-center gap-1.5 no-drag">
                            <button title="Minimizar" onclick="DesktopApp.minimizeWindow('${editWindowId}')" class="p-1 rounded hover:bg-white/20 active:bg-white/30 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" /></svg>
                            </button>
                            <button title="Maximizar" onclick="DesktopApp.maximizeWindow('${editWindowId}')" class="p-1 rounded hover:bg-white/20 active:bg-white/30 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v16H4V4z" /></svg>
                            </button>
                            <button title="Fechar" onclick="DesktopApp.closeWindow('${editWindowId}')" class="p-1 rounded hover:bg-rose-600 active:bg-rose-700 text-white transition-all cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>
                    <div class="border-b border-slate-200 bg-slate-50 px-4 py-3">
                        <p class="text-[10px] font-bold uppercase tracking-[0.24em] text-slate-400">Formulário de edição</p>
                        <h3 class="text-sm font-semibold font-outfit text-slate-800">Registro #${recordId}</h3>
                    </div>
                    <div class="flex-1 overflow-auto p-4 ext-scrollbar">
                        <form id="form-fields-${editWindowId}" onsubmit="DesktopApp.handleFormSubmit(event, '${editWindowId}')" class="space-y-4 text-slate-700 select-text">
                        </form>
                    </div>
                    <div class="h-14 border-t border-slate-100 bg-slate-50 flex items-center justify-end px-4 gap-2">
                        <button type="button" onclick="DesktopApp.closeWindow('${editWindowId}')" class="text-xs font-semibold px-4 py-2 border border-slate-200 hover:bg-slate-100 rounded text-slate-600 transition-all cursor-pointer">Cancelar</button>
                        <button type="submit" form="form-fields-${editWindowId}" class="text-xs font-semibold px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded shadow-sm transition-all cursor-pointer">Salvar</button>
                    </div>
                `;

                document.getElementById('windows-container').appendChild(win);

                this.openWindows[editWindowId] = {
                    element: win,
                    minimized: false,
                    maximized: false,
                    selectedId: recordId,
                    searchTerm: '',
                    currentPage: 1,
                    itemsPerPage: 10,
                    data: [],
                    formOpen: true,
                    formMode: 'edit',
                    sourceWindowId: sourceWinId,
                    detailRecord: rowData,
                };

                const formFieldsContainer = document.getElementById(`form-fields-${editWindowId}`);
                sourceMod.fields.forEach(field => {
                    const value = rowData[field.name] !== undefined && rowData[field.name] !== null ? rowData[field.name] : '';

                    let inputHTML = '';
                    if (field.type === 'select') {
                        inputHTML = `<select id="field-${editWindowId}-${field.name}" name="${field.name}" ${field.required ? 'required' : ''} class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">
                            ${field.nullable ? '<option value="">-- Selecionar --</option>' : ''}
                            ${(field.options || []).map(opt => `<option value="${opt.value}" ${opt.value == value ? 'selected' : ''}>${opt.label}</option>`).join('')}
                        </select>`;
                    } else if (field.type === 'textarea') {
                        inputHTML = `<textarea id="field-${editWindowId}-${field.name}" name="${field.name}" ${field.required ? 'required' : ''} rows="3" class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">${value}</textarea>`;
                    } else if (field.type === 'file') {
                        inputHTML = `<input type="file" id="field-${editWindowId}-${field.name}" name="${field.name}" ${field.accept ? `accept="${field.accept}"` : ''} ${field.required ? 'required' : ''} class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">`;
                        if (value) {
                            inputHTML += `<p class="text-[11px] text-slate-500">Arquivo atual: ${value}</p>`;
                        }
                    } else {
                        inputHTML = `<input type="${field.type}" id="field-${editWindowId}-${field.name}" name="${field.name}" value="${value}" ${field.step ? `step="${field.step}"` : ''} ${field.min !== undefined ? `min="${field.min}"` : ''} ${field.max !== undefined ? `max="${field.max}"` : ''} ${field.required ? 'required' : ''} ${field.maxLength ? `maxlength="${field.maxLength}"` : ''} placeholder="${field.placeholder || ''}" class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">`;
                    }

                    const group = document.createElement('div');
                    group.className = 'flex flex-col gap-1';
                    group.innerHTML = `
                        <label for="field-${editWindowId}-${field.name}" class="text-xs font-semibold text-slate-600">${field.label}${field.required ? ' <span class="text-rose-500">*</span>' : ''}</label>
                        ${inputHTML}
                    `;
                    formFieldsContainer.appendChild(group);
                });

                this.renderDropdownsInForm(editWindowId, rowData);
                this.addTaskToTaskbar(editWindowId);
                this.focusWindow(editWindowId);
            },

            // Select Row toggle
            selectRow(winId, id) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                // De-select previous
                if (winObj.selectedId) {
                    const prevRow = document.getElementById(`row-${winId}-${winObj.selectedId}`);
                    if (prevRow) prevRow.classList.remove('ext-grid-row-selected');
                }

                if (winObj.selectedId == id) {
                    winObj.selectedId = null;
                } else {
                    winObj.selectedId = id;
                    const newRow = document.getElementById(`row-${winId}-${id}`);
                    if (newRow) newRow.classList.add('ext-grid-row-selected');
                }

                this.updateToolbarButtons(winId);
            },

            // Enable/Disable toolbar actions based on selection
            updateToolbarButtons(winId) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                const editBtn = document.getElementById(`btn-edit-${winId}`);
                const deleteBtn = document.getElementById(`btn-delete-${winId}`);
                const selectedRowData = winObj.selectedId
                    ? winObj.data.find(row => row.id == winObj.selectedId) || {}
                    : {};
                const isPaidPayment = this.isPaidPaymentRecord(winId, selectedRowData);
                const isCanceledPayment = this.isCanceledPaymentRecord(winId, selectedRowData);
                const isDeletedPayment = this.isDeletedPaymentRecord(winId, selectedRowData);
                const isPaymentModule = this.modules[winId]?.apiEndpoint === '/api/pagamentos';

                if (!winObj.selectedId) {
                    editBtn.disabled = true;
                    editBtn.className = 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all';

                    deleteBtn.disabled = true;
                    deleteBtn.className = 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all';
                } else if (isPaidPayment) {
                    editBtn.disabled = true;
                    editBtn.className = 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all';

                    deleteBtn.disabled = true;
                    deleteBtn.className = 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all';
                } else if (isDeletedPayment) {
                    editBtn.disabled = true;
                    editBtn.className = 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all';

                    deleteBtn.disabled = true;
                    deleteBtn.className = 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all';
                } else {
                    editBtn.disabled = isCanceledPayment;
                    editBtn.className = isCanceledPayment
                        ? 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-slate-50 text-slate-400 border border-slate-200 cursor-not-allowed transition-all'
                        : 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-amber-50 text-amber-700 hover:bg-amber-100 transition-all border border-amber-200/50 cursor-pointer';

                    deleteBtn.disabled = false;
                    deleteBtn.className = 'flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded bg-rose-50 text-rose-700 hover:bg-rose-100 transition-all border border-rose-200/50 cursor-pointer';
                }

                editBtn.title = isPaidPayment || isCanceledPayment || isDeletedPayment ? 'Pagamento não pode ser editado' : 'Editar';
                deleteBtn.title = isPaymentModule
                    ? (isCanceledPayment ? 'Excluir' : 'Cancelar')
                    : 'Excluir';

                const deleteLabel = deleteBtn.querySelector('span');
                if (deleteLabel) {
                    deleteLabel.textContent = isPaymentModule
                        ? (isCanceledPayment ? 'Excluir' : (isDeletedPayment ? 'Excluir' : 'Cancelar'))
                        : 'Excluir';
                }
            },

            // Filter data on search input change
            filterGrid(winId, value) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                winObj.searchTerm = value;
                winObj.currentPage = 1;
                this.renderGrid(winId);
            },

            filterBySituacao(winId, value) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                winObj.situacaoFilter = value;
                winObj.currentPage = 1;
                this.renderGrid(winId);
            },

            // Pagination Controls
            prevPage(winId) {
                const winObj = this.openWindows[winId];
                if (winObj && winObj.currentPage > 1) {
                    winObj.currentPage--;
                    this.renderGrid(winId);
                }
            },

            nextPage(winId) {
                const winObj = this.openWindows[winId];
                if (winObj) {
                    winObj.currentPage++;
                    this.renderGrid(winId);
                }
            },

            // Show form panel (Novo/Editar Drawer)
            showForm(winId, mode = 'create') {
                const winObj = this.openWindows[winId];
                const mod = this.modules[winId];
                if (!winObj || !mod) return;

                this.hideDetails(winId);
                winObj.formOpen = true;
                winObj.formMode = mode;

                // Configure Form fields HTML
                const formFieldsContainer = document.getElementById(`form-fields-${winId}`);
                formFieldsContainer.innerHTML = '';

                // Load row data if editing
                let rowData = {};
                if (mode === 'edit') {
                    rowData = winObj.data.find(r => r.id == winObj.selectedId) || {};
                    if (this.isLockedPaymentRecord(winId, rowData)) {
                        return;
                    }
                    document.getElementById(`form-title-${winId}`).textContent = `Editar ${mod.title} #${rowData.id}`;
                } else {
                    document.getElementById(`form-title-${winId}`).textContent = `Novo ${mod.title}`;
                }

                // Render dynamic inputs based on field configuration
                mod.fields.forEach(field => {
                    let value = mode === 'edit'
                        ? (rowData[field.name] !== undefined && rowData[field.name] !== null ? rowData[field.name] : '')
                        : (field.default ? (typeof field.default === 'function' ? field.default() : field.default) : '');
                    
                    let inputHTML = '';
                    if (field.type === 'select') {
                        inputHTML = `<select id="field-${winId}-${field.name}" name="${field.name}" ${field.required ? 'required' : ''} class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">
                            ${field.nullable ? '<option value="">-- Selecionar --</option>' : ''}
                            ${(field.options || []).map(opt => `<option value="${opt.value}" ${opt.value == value ? 'selected' : ''}>${opt.label}</option>`).join('')}
                        </select>`;
                    } else if (field.type === 'textarea') {
                        inputHTML = `<textarea id="field-${winId}-${field.name}" name="${field.name}" ${field.required ? 'required' : ''} rows="3" class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">${value}</textarea>`;
                    } else if (field.type === 'file') {
                        inputHTML = `<input type="file" id="field-${winId}-${field.name}" name="${field.name}" ${field.accept ? `accept="${field.accept}"` : ''} ${field.required ? 'required' : ''} class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">`;
                        if (mode === 'edit' && value) {
                            inputHTML += `<p class="text-[11px] text-slate-500">Arquivo atual: ${value}</p>`;
                        }
                    } else {
                        inputHTML = `<input type="${field.type}" id="field-${winId}-${field.name}" name="${field.name}" value="${value}" ${field.step ? `step="${field.step}"` : ''} ${field.min !== undefined ? `min="${field.min}"` : ''} ${field.max !== undefined ? `max="${field.max}"` : ''} ${field.required ? 'required' : ''} ${field.maxLength ? `maxlength="${field.maxLength}"` : ''} placeholder="${field.placeholder || ''}" class="w-full text-xs border border-slate-200 rounded px-2.5 py-1.5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition-all select-text">`;
                    }

                    const group = document.createElement('div');
                    group.className = 'flex flex-col gap-1';
                    group.innerHTML = `
                        <label for="field-${winId}-${field.name}" class="text-xs font-semibold text-slate-600">${field.label}${field.required ? ' <span class="text-rose-500">*</span>' : ''}</label>
                        ${inputHTML}
                    `;
                    formFieldsContainer.appendChild(group);
                });

                // Populate cache lists if fields need dynamic selects
                this.renderDropdownsInForm(winId, rowData);

                // Show Drawer with slide animations
                const drawer = document.getElementById(`form-drawer-${winId}`);
                const content = document.getElementById(`form-content-${winId}`);
                drawer.className = 'absolute inset-x-0 bottom-9 top-10 bg-slate-900/40 backdrop-blur-xs flex justify-end z-[50] pointer-events-auto';
                setTimeout(() => {
                    content.classList.remove('translate-x-full');
                }, 10);
            },

            // Render dynamic options inside form select inputs using background cash data
            renderDropdownsInForm(winId, rowData = {}) {
                const mod = this.modules[winId];
                if (!mod) return;

                mod.fields.forEach(field => {
                    if (field.type === 'select' && field.cacheResource) {
                        const select = document.getElementById(`field-${winId}-${field.name}`);
                        if (!select) return;

                        const items = this.cache[field.cacheResource] || [];
                        const selectedVal = winObj => winObj.formMode === 'edit' 
                            ? (rowData[field.name] !== undefined && rowData[field.name] !== null ? rowData[field.name] : '')
                            : (field.default ? (typeof field.default === 'function' ? field.default() : field.default) : '');

                        const activeVal = selectedVal(this.openWindows[winId]);

                        select.innerHTML = `
                            ${field.required ? '' : '<option value="">-- Nenhum --</option>'}
                            ${items.map(item => {
                                const name = item.nome || item.codigo_pedido || `Item ID: ${item.id}`;
                                return `<option value="${item.id}" ${item.id == activeVal ? 'selected' : ''}>${name}</option>`;
                            }).join('')}
                        `;
                    }
                });
            },

            hideForm(winId) {
                const winObj = this.openWindows[winId];
                if (!winObj) return;

                const content = document.getElementById(`form-content-${winId}`);
                const drawer = document.getElementById(`form-drawer-${winId}`);

                content.classList.add('translate-x-full');
                setTimeout(() => {
                    drawer.className = 'absolute inset-x-0 bottom-9 top-10 bg-slate-900/40 backdrop-blur-xs hidden justify-end z-[50] pointer-events-auto';
                    winObj.formOpen = false;
                }, 200);
            },

            // CRUD action Edit
            editSelected(winId) {
                const winObj = this.openWindows[winId];
                if (winObj && winObj.selectedId) {
                    this.showForm(winId, 'edit');
                }
            },

            // CRUD action Form Submit (POST/PUT API requests)
            async handleFormSubmit(e, winId) {
                e.preventDefault();
                const winObj = this.openWindows[winId];
                const mod = this.modules[winId];
                if (!winObj || !mod) return;

                const formEl = document.getElementById(`form-fields-${winId}`);
                const hasFileField = mod.fields.some(field => field.type === 'file');
                const formData = new FormData(formEl);
                const payload = {};

                if (hasFileField) {
                    mod.fields.forEach(field => {
                        if (field.type === 'file') {
                            const input = document.getElementById(`field-${winId}-${field.name}`);
                            if (input && input.files && input.files.length === 0) {
                                formData.delete(field.name);
                            }
                        }
                    });
                }

                if (!hasFileField) {
                    formData.forEach((value, key) => {
                        payload[key] = value === '' ? null : value;
                    });
                }

                const isEdit = winObj.formMode === 'edit';
                const url = isEdit ? `${mod.apiEndpoint}/${winObj.selectedId}` : mod.apiEndpoint;
                const method = hasFileField && isEdit ? 'POST' : (isEdit ? 'PUT' : 'POST');
                const sourceWindowId = winObj.sourceWindowId || winId;

                if (hasFileField && isEdit) {
                    formData.set('_method', 'PUT');
                }

                try {
                    const requestOptions = {
                        method: method,
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    };

                    if (hasFileField) {
                        requestOptions.body = formData;
                    } else {
                        requestOptions.headers['Content-Type'] = 'application/json';
                        requestOptions.body = JSON.stringify(payload);
                    }

                    const response = await fetch(url, {
                        ...requestOptions
                    });

                    const responseData = await response.json();
                    
                    if (response.ok) {
                        this.showToast(`Sucesso: ${mod.title} ${isEdit ? 'atualizado' : 'criado'} com sucesso!`, 'success');
                        if (this.isDetailWindow(winId)) {
                            this.closeWindow(winId);
                        } else {
                            this.hideForm(winId);
                        }

                        this.loadCache();
                        this.refreshGrid(sourceWindowId);
                    } else {
                        // Backend validation issues mapping
                        const errMsg = responseData.message || 'Erro de validação';
                        const errors = responseData.errors ? Object.values(responseData.errors).flat().join('\n') : '';
                        this.showToast(`${errMsg}\n${errors}`, 'error');
                    }
                } catch (error) {
                    console.error('Error submitting form:', error);
                    this.showToast('Erro interno de rede ao enviar os dados.', 'error');
                }
            },

            // CRUD action Delete (DELETE API request)
            async deleteSelected(winId) {
                const winObj = this.openWindows[winId];
                const mod = this.modules[winId];
                if (!winObj || !winObj.selectedId || !mod) return;

                const isPaymentModule = mod.apiEndpoint === '/api/pagamentos';
                const confirmMessage = isPaymentModule
                    ? 'Deseja realmente cancelar este pagamento? Esta ação não pode ser desfeita.'
                    : `Deseja realmente remover este item de ${mod.title}? Esta ação não pode ser desfeita.`;

                if (!confirm(confirmMessage)) return;

                try {
                    const response = await fetch(`${mod.apiEndpoint}/${winObj.selectedId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    if (response.ok || response.status === 204) {
                        this.showToast(
                            isPaymentModule ? 'Pagamento cancelado com sucesso.' : `Item excluído de ${mod.title} com sucesso.`,
                            'success'
                        );
                        
                        // Reload cache & list Grid
                        this.loadCache();
                        this.refreshGrid(winId);
                    } else {
                        const err = await response.json();
                        this.showToast(`Erro ao excluir: ${err.message || 'Item possui dependências ativas.'}`, 'error');
                    }
                } catch (error) {
                    console.error('Error deleting record:', error);
                    this.showToast('Erro interno de rede ao tentar excluir registro.', 'error');
                }
            },

            // Custom Notification Toast System
            showToast(message, type = 'success') {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                
                const typeClasses = type === 'success' 
                    ? 'bg-emerald-800/95 border-emerald-600/30 text-white' 
                    : 'bg-rose-900/95 border-rose-600/30 text-white';

                toast.className = `p-3.5 rounded-lg border shadow-xl flex items-center gap-3 w-80 text-xs font-medium font-outfit select-text pointer-events-auto transition-all transform translate-y-2 opacity-0 ${typeClasses}`;
                
                const icon = type === 'success'
                    ? `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`
                    : `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`;

                toast.innerHTML = `
                    ${icon}
                    <div class="flex-1 leading-relaxed white-space-pre-line">${message}</div>
                `;

                container.appendChild(toast);
                
                // Animate entry
                setTimeout(() => {
                    toast.classList.remove('translate-y-2', 'opacity-0');
                }, 10);

                // Auto destroy after 4 seconds
                setTimeout(() => {
                    toast.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 4000);
            },

            // Utility format currency
            formatCurrency(value) {
                if (value === null || value === undefined) return 'R$ 0,00';
                return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
            },

            // Utility format date
            formatDate(value) {
                if (!value) return '—';
                try {
                    const date = new Date(value);
                    if (isNaN(date.getTime())) return value;
                    // Format without timezone offsets problems
                    const parts = value.split('-');
                    if (parts.length === 3) {
                        return `${parts[2]}/${parts[1]}/${parts[0]}`;
                    }
                    return date.toLocaleDateString('pt-BR');
                } catch (e) {
                    return value;
                }
            }
        };

        // Window load start
        window.addEventListener('DOMContentLoaded', () => {
            DesktopApp.init();
        });
    </script>
</body>
</html>
