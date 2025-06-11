<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Análise de Vínculos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <style>
        #mynetwork { width: 100%; height: 700px; border: 1px solid lightgray; background-color: #f7f7f7; }
        .search-results { max-height: 200px; display: none; }
        .search-results.show { display: block; }
    </style>
</head>
<body class="bg-gray-100">

    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold">SAVIP</div>
                <div>
                    <a href="casos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Casos</a>
                    <a href="index.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Pessoas</a>
                    <a href="ocorrencias.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Ocorrências</a>
                    <a href="veiculos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Veículos</a>
                    <a href="objetos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Objetos</a>
                    <a href="telefones.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Telefones</a>
                    <a href="analise.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Análise de Vínculos</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Análise de Vínculos</h1>
            <p class="text-gray-500 mt-1">Selecione uma entidade para visualizar sua rede de conexões.</p>
        </header>

        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="search-pessoa-analise" class="block text-sm font-medium text-gray-700">Buscar por Pessoa</label>
                    <div class="relative mt-1">
                        <input type="text" id="search-pessoa-analise" placeholder="Digite o nome ou CPF..." class="w-full p-2 border border-gray-300 rounded-md">
                        <div id="search-results-pessoa" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg overflow-y-auto"></div>
                    </div>
                </div>
                <div>
                    <label for="search-caso-analise" class="block text-sm font-medium text-gray-700">Buscar por Caso</label>
                     <div class="relative mt-1">
                        <input type="text" id="search-caso-analise" placeholder="Digite o nº do Inquérito..." class="w-full p-2 border border-gray-300 rounded-md">
                        <div id="search-results-caso" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg overflow-y-auto"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div id="mynetwork"></div>
        </div>
    </div>

    <script>
        const API_URL = 'api.php';
        const networkContainer = document.getElementById('mynetwork');
        let network = null;

        const graphOptions = {
            nodes: { shape: 'dot', size: 20, font: { size: 15, color: '#333' }, borderWidth: 2 },
            edges: { width: 2, color: { inherit: 'from' }, arrows: { to: { enabled: true, scaleFactor: 0.5 } }, font: { align: 'top' } },
            physics: { solver: 'forceAtlas2Based', forceAtlas2Based: { gravitationalConstant: -50, centralGravity: 0.01, springConstant: 0.08, springLength: 100, damping: 0.4, avoidOverlap: 1 }},
            groups: {
                pessoa: { color: { background: '#97C2FC', border: '#2B7CE9' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", code: '\uf007', size: 50, color: '#2B7CE9' }},
                ocorrencia: { color: { background: '#FFC2B5', border: '#FF6347' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", code: '\uf15c', size: 50, color: '#FF6347' }},
                caso: { color: { background: '#D2B4DE', border: '#8E44AD' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", weight: "900", code: '\uf0e3', size: 50, color: '#8E44AD' }} // Ícone de maleta/dossiê
            },
            interaction: { hover: true, tooltipDelay: 200 }
        };

        function setupSearch(inputId, resultsId, searchAction, onSelect, getLabel) {
            const searchInput = document.getElementById(inputId);
            const searchResults = document.getElementById(resultsId);
            searchInput.addEventListener('keyup', async (e) => {
                const term = e.target.value.trim();
                if (term.length < 2) { searchResults.classList.remove('show'); return; }
                const response = await fetch(`${API_URL}?action=${searchAction}&term=${term}`);
                const items = await response.json();
                searchResults.innerHTML = '';
                if (items.length > 0) {
                    items.forEach(item => {
                        const div = document.createElement('div');
                        div.innerHTML = getLabel(item);
                        div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                        div.onclick = () => { onSelect(item); searchInput.value = getLabel(item); searchResults.classList.remove('show'); };
                        searchResults.appendChild(div);
                    });
                    searchResults.classList.add('show');
                }
            });
        }

        async function drawGraph(url) {
            networkContainer.innerHTML = '<p class="text-center p-10 text-gray-500">Buscando conexões...</p>';
            try {
                const response = await fetch(url);
                const graphData = await response.json();
                if (graphData.nodes.length <= 1) {
                     networkContainer.innerHTML = '<p class="text-center p-10 text-gray-500">Nenhuma conexão encontrada para esta entidade.</p>';
                     return;
                }
                // Adiciona o prefixo 'pessoa_' aos IDs de nós de pessoas para evitar conflitos
                graphData.nodes.forEach(node => {
                    if (node.group === 'pessoa' && !String(node.id).startsWith('pessoa_')) {
                        node.id = 'pessoa_' + node.id;
                    }
                });
                graphData.edges.forEach(edge => {
                    if (graphData.nodes.find(n => n.id === edge.from)?.group === 'pessoa' && !String(edge.from).startsWith('pessoa_')) {
                        edge.from = 'pessoa_' + edge.from;
                    }
                    if (graphData.nodes.find(n => n.id === edge.to)?.group === 'pessoa' && !String(edge.to).startsWith('pessoa_')) {
                        edge.to = 'pessoa_' + edge.to;
                    }
                });
                network = new vis.Network(networkContainer, graphData, graphOptions);
            } catch (error) {
                console.error("Erro ao gerar o grafo:", error);
                networkContainer.innerHTML = '<p class="text-red-500 text-center p-10">Ocorreu um erro ao gerar o grafo.</p>';
            }
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            setupSearch('search-pessoa-analise', 'search-results-pessoa', 'searchPessoas', (item) => drawGraph(`${API_URL}?action=getGraphData&pessoa_id=${item.id}`), item => item.nome_completo);
            setupSearch('search-caso-analise', 'search-results-caso', 'searchCasos', (item) => drawGraph(`${API_URL}?action=getGraphDataForCase&caso_id=${item.id}`), item => `IP: ${item.inquerito_policial}`);
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>