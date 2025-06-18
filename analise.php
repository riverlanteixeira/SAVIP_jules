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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100">

    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold">SAVIP</div>
                <div><a href="casos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Casos</a><a
                        href="index.php" class="px-3 py-2 rounded-md text-sm font-medium bg-gray-900">Pessoas</a>
                        <a href="ocorrencias.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Ocorrências</a>
                        <a href="locais.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Locais</a>
                        <a href="veiculos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Veículos</a><a
                        href="objetos.php"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Objetos</a><a
                        href="telefones.php"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Telefones</a><a
                        href="analise.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Análise de
                        Vínculos</a></div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-700">Análise de Vínculos</h1>
                    <p class="text-gray-500 mt-1">Selecione uma entidade para visualizar sua rede de conexões.</p>
                </div>
                <div>
                    <button onclick="toggleModal('add-vinculo-modal', true)" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                        Criar Vínculo Manual
                    </button>
                </div>
            </div>
        </header>
 
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="search-pessoa-analise" class="block text-sm font-medium text-gray-700">Buscar por Pessoa</label>
                    <div class="relative mt-1"><input type="text" id="search-pessoa-analise" placeholder="Digite o nome ou CPF..." class="w-full p-2 border border-gray-300 rounded-md"><div id="search-results-pessoa" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg overflow-y-auto"></div></div>
                </div>
                <div>
                    <label for="search-caso-analise" class="block text-sm font-medium text-gray-700">Buscar por Caso</label>
                     <div class="relative mt-1"><input type="text" id="search-caso-analise" placeholder="Digite o nº do Inquérito..." class="w-full p-2 border border-gray-300 rounded-md"><div id="search-results-caso" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg overflow-y-auto"></div></div>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div id="mynetwork"></div>
        </div>
    </div>

    <div id="add-vinculo-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="bg-white w-11/12 md:max-w-3xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Criar Vínculo Manual</p>
                    <div class="cursor-pointer z-50" onclick="toggleModal('add-vinculo-modal', false)"><span class="text-3xl">&times;</span></div>
                </div>
                <form id="form-add-vinculo" class="py-4 space-y-4">
                    <div class="flex gap-4">
                        <div class="w-1/2 space-y-2">
                            <h4 class="font-semibold">Origem do Vínculo (Entidade 1)</h4>
                            <select id="vinculo-entidade1-tipo" class="w-full p-2 border rounded">
                                <option value="pessoa">Pessoa</option>
                                <option value="veiculo">Veículo</option>
                                <option value="objeto">Objeto</option>
                                <option value="telefone">Telefone</option>
                            </select>
                            <div class="relative">
                                <input type="text" id="vinculo-search1" placeholder="Buscar..." class="w-full p-2 border rounded">
                                <div id="vinculo-search-results1" class="search-results absolute z-30 w-full bg-white border mt-1 rounded shadow-lg"></div>
                            </div>
                            <div id="vinculo-linked1" class="mt-2 text-sm"></div>
                        </div>
                        <div class="w-1/2 space-y-2">
                            <h4 class="font-semibold">Alvo do Vínculo (Entidade 2)</h4>
                            <select id="vinculo-entidade2-tipo" class="w-full p-2 border rounded">
                                <option value="pessoa">Pessoa</option>
                                <option value="veiculo">Veículo</option>
                                <option value="objeto">Objeto</option>
                                <option value="telefone">Telefone</option>
                            </select>
                            <div class="relative">
                                <input type="text" id="vinculo-search2" placeholder="Buscar..." class="w-full p-2 border rounded">
                                <div id="vinculo-search-results2" class="search-results absolute z-30 w-full bg-white border mt-1 rounded shadow-lg"></div>
                            </div>
                            <div id="vinculo-linked2" class="mt-2 text-sm"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Tipo de Vínculo</label>
                            <input type="text" id="vinculo-tipo" placeholder="Ex: Familiar, Criminal, Profissional" class="w-full p-2 border rounded" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Intensidade</label>
                            <select id="vinculo-intensidade" class="w-full p-2 border rounded">
                                <option>Forte</option><option selected>Médio</option><option>Fraco</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium">Fonte da Informação</label>
                            <input type="text" id="vinculo-fonte" placeholder="Ex: Depoimento da testemunha X" class="w-full p-2 border rounded">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4 mt-4 border-t">
                        <button type="button" class="px-4 bg-gray-200 p-3 rounded-lg mr-2" onclick="toggleModal('add-vinculo-modal', false)">Cancelar</button>
                        <button type="submit" class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Vínculo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
// >>> CÓDIGO JAVASCRIPT COMPLETO E CORRIGIDO PARA analise.php <<<

const API_URL = 'api.php';
const networkContainer = document.getElementById('mynetwork');
let network = null;

const graphOptions = {
    nodes: { shape: 'dot', size: 20, font: { size: 15, color: '#333' }, borderWidth: 2 },
    edges: { width: 2, color: { inherit: 'from' }, arrows: { to: { enabled: true, scaleFactor: 0.5 } }, font: { align: 'top', size: 12, color: '#888' } },
    physics: { solver: 'forceAtlas2Based', forceAtlas2Based: { gravitationalConstant: -50, centralGravity: 0.01, springConstant: 0.08, springLength: 150, damping: 0.4 }},
    groups: {
        pessoa: { color: { background: '#97C2FC', border: '#2B7CE9' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", weight: "900", code: '\uf007', size: 50, color: '#2B7CE9' }},
        ocorrencia: { color: { background: '#FFC2B5', border: '#FF6347' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", weight: "900", code: '\uf15c', size: 50, color: '#FF6347' }},
        caso: { color: { background: '#D2B4DE', border: '#8E44AD' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", weight: "900", code: '\uf0e3', size: 50, color: '#8E44AD' }},
        veiculo: { color: { background: '#f5b975', border: '#f0932b' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", weight: "900", code: '\uf1b9', size: 50, color: '#f0932b' }},
        objeto: { color: { background: '#7bed9f', border: '#2ed573' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", weight: "900", code: '\uf466', size: 50, color: '#2ed573' }},
        telefone: { color: { background: '#eccc68', border: '#ffa502' }, shape: 'icon', icon: { face: "'Font Awesome 5 Free'", weight: "900", code: '\uf3cd', size: 50, color: '#ffa502' }}
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
                div.innerHTML = escapeHTML(getLabel(item));
                div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                div.onclick = () => {
                    onSelect(item);
                    searchInput.value = '';
                    searchResults.classList.remove('show');
                };
                searchResults.appendChild(div);
            });
            searchResults.classList.add('show');
        } else {
            searchResults.classList.remove('show');
        }
    });
     document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.classList.remove('show');
        }
    });
}

async function drawGraph(url) {
    networkContainer.innerHTML = '<p class="text-center p-10 text-gray-500">Buscando conexões...</p>';
    try {
        const response = await fetch(url);
        const graphData = await response.json();
        if (!graphData || !graphData.nodes || graphData.nodes.length === 0) {
             networkContainer.innerHTML = '<p class="text-center p-10 text-gray-500">Nenhuma entidade principal encontrada.</p>';
             return;
        }
        if (graphData.nodes.length <= 1 && graphData.edges.length === 0) {
             networkContainer.innerHTML = '<p class="text-center p-10 text-gray-500">Nenhuma conexão encontrada para esta entidade.</p>';
             return;
        }
        network = new vis.Network(networkContainer, graphData, graphOptions);
    } catch (error) {
        console.error("Erro ao gerar o grafo:", error);
        networkContainer.innerHTML = '<p class="text-red-500 text-center p-10">Ocorreu um erro ao gerar o grafo.</p>';
    }
}

let entidade1 = null, entidade2 = null;

function createVinculoSearch(num) {
    const tipoSelect = document.getElementById(`vinculo-entidade${num}-tipo`);
    const searchInput = document.getElementById(`vinculo-search${num}`);
    const linkedDiv = document.getElementById(`vinculo-linked${num}`);

    const searchActions = {
        pessoa: 'searchPessoas', veiculo: 'searchVeiculos', objeto: 'searchObjetos', telefone: 'searchTelefones'
    };
    const labelGetters = {
        pessoa: item => item.nome_completo,
        veiculo: item => `Placa: ${item.placa}`,
        objeto: item => item.tipo,
        telefone: item => item.numero
    };

    const onSelect = (item) => {
        if (num === 1) entidade1 = { id: item.id, tipo: tipoSelect.value };
        else entidade2 = { id: item.id, tipo: tipoSelect.value };
        linkedDiv.innerHTML = `<div class="p-2 border rounded bg-gray-100">${escapeHTML(labelGetters[tipoSelect.value](item))}</div>`;
    };

    const setup = () => {
        setupSearch(`vinculo-search${num}`, `vinculo-search-results${num}`, searchActions[tipoSelect.value], onSelect, labelGetters[tipoSelect.value]);
    };
    
    tipoSelect.addEventListener('change', () => {
        if (num === 1) entidade1 = null; else entidade2 = null;
        linkedDiv.innerHTML = '';
        searchInput.value = '';
        setup();
    });
    setup();
}

document.getElementById('form-add-vinculo').addEventListener('submit', async (e) => {
    e.preventDefault();
    if (!entidade1 || !entidade2) {
        alert('Selecione as duas entidades para criar o vínculo.');
        return;
    }
    const payload = {
        entidade1_tipo: entidade1.tipo,
        entidade1_id: entidade1.id,
        entidade2_tipo: entidade2.tipo,
        entidade2_id: entidade2.id,
        tipo_vinculo: document.getElementById('vinculo-tipo').value,
        intensidade: document.getElementById('vinculo-intensidade').value,
        fonte_info: document.getElementById('vinculo-fonte').value
    };

    const response = await fetch(`${API_URL}?action=addVinculoManual`, { method: 'POST', body: JSON.stringify(payload), headers: {'Content-Type': 'application/json'} });
    const result = await response.json();
    if (result.success) {
        alert(result.message);
        toggleModal('add-vinculo-modal', false);
        // Relevance alert check
        if (result.relevance_alert && result.relevant_entities && result.relevant_entities.length > 0) {
            let alertMessage = "Alerta de Relevância:\n";
            result.relevant_entities.forEach(entity => {
                alertMessage += `- ${entity.label} (ID: ${entity.id}) é de alto interesse.\n`;
            });
            alert(alertMessage);
        }
        e.target.reset();
        entidade1 = null; entidade2 = null;
        document.getElementById('vinculo-linked1').innerHTML = '';
        document.getElementById('vinculo-linked2').innerHTML = '';
    } else {
        alert('Erro: ' + (result.message || 'Erro desconhecido.'));
    }
});

function toggleModal(modalId, show) {
    const modal = document.getElementById(modalId);
    if(modal) {
        if(show) modal.style.display = 'flex';
        else modal.style.display = 'none';
    }
}

function escapeHTML(str) {
    if (str === null || typeof str === 'undefined') return '';
    const div = document.createElement('div');
    div.appendChild(document.createTextNode(String(str)));
    return div.innerHTML;
}

document.addEventListener('DOMContentLoaded', () => {
    setupSearch('search-pessoa-analise', 'search-results-pessoa', 'searchPessoas', 
        (item) => drawGraph(`${API_URL}?action=getGraphData&pessoa_id=${item.id}`), 
        item => item.nome_completo);
    setupSearch('search-caso-analise', 'search-results-caso', 'searchCasos', 
        (item) => drawGraph(`${API_URL}?action=getGraphDataForCase&caso_id=${item.id}`), 
        item => `IP: ${item.inquerito_policial}`);
    createVinculoSearch(1);
    createVinculoSearch(2);
});
</script>

    
</body>
</html>