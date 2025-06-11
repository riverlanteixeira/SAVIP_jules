<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Gestão de Casos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .search-results { max-height: 150px; display: none; }
        .search-results.show { display: block; }
        .modal { display: none; }
        .modal.flex { display: flex; }
    </style>
</head>
<body class="bg-gray-100">

    <nav class="bg-gray-800 text-white shadow-lg"><div class="container mx-auto px-6 py-3"><div class="flex justify-between items-center"><div class="text-xl font-bold">SAVIP</div><div><a href="casos.php" class="px-3 py-2 rounded-md text-sm font-medium bg-gray-900">Casos</a><a href="index.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Pessoas</a><a href="ocorrencias.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Ocorrências</a><a href="veiculos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Veículos</a><a href="objetos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Objetos</a><a href="telefones.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Telefones</a><a href="analise.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Análise de Vínculos</a></div></div></div></nav>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Gestão de Casos</h1>
            <p class="text-gray-500 mt-1">Crie e gerencie os dossiês das suas investigações.</p>
        </header>
        
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Criar Novo Caso</h2>
            <form id="form-add-caso">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informações do Caso</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-4">
                    <div><label for="inquerito_policial" class="block text-sm font-medium">Nº Inquérito</label><input type="text" id="inquerito_policial" name="inquerito_policial" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="autos" class="block text-sm font-medium">Nº Autos</label><input type="text" id="autos" name="autos" class="mt-1 w-full p-2 border rounded"></div>
                    <div class="md:col-span-2"><label for="relato_fatos" class="block text-sm font-medium">Relato dos Fatos</label><textarea id="relato_fatos" name="relato_fatos" rows="4" class="mt-1 w-full p-2 border rounded"></textarea></div>
                </div>

                <h3 class="text-lg font-semibold mb-4 mt-8 border-b pb-2">Vincular Entidades ao Caso</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8">
                    <div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Pessoa</label><div class="relative"><input type="text" id="search-pessoa" placeholder="Nome ou CPF..." class="mt-1 w-full p-2 border rounded"><div id="search-results-pessoa" class="search-results absolute z-20 w-full bg-white border mt-1 rounded shadow-lg"></div></div><div id="linked-pessoas-list" class="mt-2 space-y-2"></div></div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Veículo</label><div class="relative"><input type="text" id="search-veiculo" placeholder="Placa ou modelo..." class="mt-1 w-full p-2 border rounded"><div id="search-results-veiculo" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg"></div></div><div id="linked-veiculos-list" class="mt-2 space-y-2"></div></div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Telefone</label><div class="relative"><input type="text" id="search-telefone" placeholder="Número ou IMEI..." class="mt-1 w-full p-2 border rounded"><div id="search-results-telefone" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg"></div></div><div id="linked-telefones-list" class="mt-2 space-y-2"></div></div>
                    </div>
                    <div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Ocorrência</label><div class="relative"><input type="text" id="search-ocorrencia" placeholder="Número do BO..." class="mt-1 w-full p-2 border rounded"><div id="search-results-ocorrencia" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg"></div></div><div id="linked-ocorrencias-list" class="mt-2 space-y-2"></div></div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Objeto</label><div class="relative"><input type="text" id="search-objeto" placeholder="Tipo ou marca..." class="mt-1 w-full p-2 border rounded"><div id="search-results-objeto" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg"></div></div><div id="linked-objetos-list" class="mt-2 space-y-2"></div></div>
                    </div>
                </div>
                <div class="mt-8 text-right"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar Novo Caso</button></div>
            </form>
        </div>

        </div>

    <script>
        const API_URL = 'api.php';
// Arrays para armazenar os itens vinculados nos formulários de Adição e Edição
let linkedPessoas = [], linkedOcorrencias = [], linkedVeiculos = [], linkedObjetos = [], linkedTelefones = [];
let linkedPessoasEdit = [], linkedOcorrenciasEdit = [], linkedVeiculosEdit = [], linkedObjetosEdit = [], linkedTelefonesEdit = [];

// --- Seletores de Elementos ---
const formAddCaso = document.getElementById('form-add-caso');
const formEditCaso = document.getElementById('form-edit-caso');
const confirmDeleteCaseBtn = document.getElementById('confirm-delete-case-btn');

// --- Funções Auxiliares ---
function toggleModal(modalId, show) {
    const modal = document.getElementById(modalId);
    if (show) modal.classList.add('flex');
    else modal.classList.remove('flex');
}

function setupGenericSearch(inputId, resultsId, searchAction, addFunction, getLabel) {
    const searchInput = document.getElementById(inputId);
    const searchResults = document.getElementById(resultsId);
    if (!searchInput) { console.error("Elemento de busca não encontrado:", inputId); return; }
    searchInput.addEventListener('keyup', async (e) => {
        const term = e.target.value.trim();
        if (term.length < 2) { searchResults.classList.remove('show'); return; }
        try {
            const response = await fetch(`${API_URL}?action=${searchAction}&term=${term}`);
            const items = await response.json();
            searchResults.innerHTML = '';
            if (items.length > 0) {
                items.forEach(item => {
                    const div = document.createElement('div');
                    div.innerHTML = getLabel(item);
                    div.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                    div.onclick = () => { addFunction(item); searchInput.value = ''; searchResults.classList.remove('show'); };
                    searchResults.appendChild(div);
                });
                searchResults.classList.add('show');
            }
        } catch (error) { console.error(`Erro na busca (${searchAction}):`, error); }
    });
}

function renderLinkedList(listId, items, removeFunctionName, getLabel) {
    const listElement = document.getElementById(listId);
    listElement.innerHTML = '';
    items.forEach((item, index) => {
        const div = document.createElement('div');
        div.className = 'p-2 border rounded flex justify-between items-center text-sm bg-gray-50';
        div.innerHTML = `<span>${getLabel(item)}</span><button type="button" onclick="${removeFunctionName}(${index})" class="text-red-500 font-bold px-2">X</button>`;
        listElement.appendChild(div);
    });
}

function renderPessoasList(isEdit) {
    const listId = isEdit ? 'edit-linked-pessoas-list' : 'linked-pessoas-list';
    const items = isEdit ? linkedPessoasEdit : linkedPessoas;
    const removeFn = isEdit ? 'removePessoaEdit' : 'removePessoa';
    const listElement = document.getElementById(listId);
    listElement.innerHTML = '';
    items.forEach((pessoa, index) => {
        const div = document.createElement('div');
        div.className = 'p-2 border rounded flex justify-between items-center bg-gray-50';
        div.innerHTML = `<span>${pessoa.nome_completo}</span><div><label class="text-sm mr-2">Atuação:</label><select class="p-1 border rounded mr-4" data-pessoa-id="${pessoa.id}"><option ${pessoa.atuacao === 'Suspeito' ? 'selected' : ''}>Suspeito</option><option ${pessoa.atuacao === 'Autor' ? 'selected' : ''}>Autor</option><option ${pessoa.atuacao === 'Vítima' ? 'selected' : ''}>Vítima</option><option ${pessoa.atuacao === 'Testemunha' ? 'selected' : ''}>Testemunha</option><option ${pessoa.atuacao === 'Outro' ? 'selected' : ''}>Outro</option></select><button type="button" onclick="${removeFn}(${index})" class="text-red-500 font-bold px-2">X</button></div>`;
        listElement.appendChild(div);
    });
}

// --- Funções de ADIÇÃO ---
function addPessoa(p) { if (!linkedPessoas.find(i => i.id === p.id)) { linkedPessoas.push(p); renderPessoasList(false); } }
function addOcorrencia(o) { if (!linkedOcorrencias.find(i => i.id === o.id)) { linkedOcorrencias.push(o); renderLinkedList('linked-ocorrencias-list', linkedOcorrencias, 'removeOcorrencia', item => `BO: ${item.numero_bo}`); } }
function addVeiculo(v) { if (!linkedVeiculos.find(i => i.id === v.id)) { linkedVeiculos.push(v); renderLinkedList('linked-veiculos-list', linkedVeiculos, 'removeVeiculo', item => `Placa: ${item.placa || 'N/A'}`); } }
function addObjeto(o) { if (!linkedObjetos.find(i => i.id === o.id)) { linkedObjetos.push(o); renderLinkedList('linked-objetos-list', linkedObjetos, 'removeObjeto', item => `${item.tipo} - ${item.marca||''}`); } }
function addTelefone(t) { if (!linkedTelefones.find(i => i.id === t.id)) { linkedTelefones.push(t); renderLinkedList('linked-telefones-list', linkedTelefones, 'removeTelefone', item => item.numero); } }
function removePessoa(index) { linkedPessoas.splice(index, 1); renderPessoasList(false); }
function removeOcorrencia(index) { linkedOcorrencias.splice(index, 1); renderLinkedList('linked-ocorrencias-list', linkedOcorrencias, 'removeOcorrencia', item => `BO: ${item.numero_bo}`); }
function removeVeiculo(index) { linkedVeiculos.splice(index, 1); renderLinkedList('linked-veiculos-list', linkedVeiculos, 'removeVeiculo', item => `Placa: ${item.placa || 'N/A'}`); }
function removeObjeto(index) { linkedObjetos.splice(index, 1); renderLinkedList('linked-objetos-list', linkedObjetos, 'removeObjeto', item => `${item.tipo} - ${item.marca||''}`); }
function removeTelefone(index) { linkedTelefones.splice(index, 1); renderLinkedList('linked-telefones-list', linkedTelefones, 'removeTelefone', item => item.numero); }

// --- Funções de EDIÇÃO ---
function addPessoaEdit(p) { if (!linkedPessoasEdit.find(i => i.id === p.id)) { linkedPessoasEdit.push(p); renderPessoasList(true); } }
function addOcorrenciaEdit(o) { if (!linkedOcorrenciasEdit.find(i => i.id === o.id)) { linkedOcorrenciasEdit.push(o); renderLinkedList('edit-linked-ocorrencias-list', linkedOcorrenciasEdit, 'removeOcorrenciaEdit', item => `BO: ${item.numero_bo}`); } }
function addVeiculoEdit(v) { if (!linkedVeiculosEdit.find(i => i.id === v.id)) { linkedVeiculosEdit.push(v); renderLinkedList('edit-linked-veiculos-list', linkedVeiculosEdit, 'removeVeiculoEdit', item => `Placa: ${item.placa || 'N/A'}`); } }
function addObjetoEdit(o) { if (!linkedObjetosEdit.find(i => i.id === o.id)) { linkedObjetosEdit.push(o); renderLinkedList('edit-linked-objetos-list', linkedObjetosEdit, 'removeObjetoEdit', item => `${item.tipo} - ${item.marca||''}`); } }
function addTelefoneEdit(t) { if (!linkedTelefonesEdit.find(i => i.id === t.id)) { linkedTelefonesEdit.push(t); renderLinkedList('edit-linked-telefones-list', linkedTelefonesEdit, 'removeTelefoneEdit', item => item.numero); } }
function removePessoaEdit(index) { linkedPessoasEdit.splice(index, 1); renderPessoasList(true); }
function removeOcorrenciaEdit(index) { linkedOcorrenciasEdit.splice(index, 1); renderLinkedList('edit-linked-ocorrencias-list', linkedOcorrenciasEdit, 'removeOcorrenciaEdit', item => `BO: ${item.numero_bo}`); }
function removeVeiculoEdit(index) { linkedVeiculosEdit.splice(index, 1); renderLinkedList('edit-linked-veiculos-list', linkedVeiculosEdit, 'removeVeiculoEdit', item => `Placa: ${item.placa || 'N/A'}`); }
function removeObjetoEdit(index) { linkedObjetosEdit.splice(index, 1); renderLinkedList('edit-linked-objetos-list', linkedObjetosEdit, 'removeObjetoEdit', item => `${item.tipo} - ${item.marca||''}`); }
function removeTelefoneEdit(index) { linkedTelefonesEdit.splice(index, 1); renderLinkedList('edit-linked-telefones-list', linkedTelefonesEdit, 'removeTelefoneEdit', item => item.numero); }


// --- Funções Principais (CRUD) ---
async function carregarCasos() {
    const response = await fetch(`${API_URL}?action=getCasos`);
    const casos = await response.json();
    const listaCasos = document.getElementById('lista-casos');
    listaCasos.innerHTML = '';
    if (casos.length > 0) {
        casos.forEach(item => {
            const tr = document.createElement('tr');
            tr.className = 'border-b hover:bg-gray-50';
            tr.innerHTML = `<td class="py-3 px-4">${item.id}</td><td class="py-3 px-4">${item.inquerito_policial||'N/A'}</td><td class="py-3 px-4">${new Date(item.data_criacao).toLocaleDateString('pt-BR')}</td><td class="py-3 px-4 text-center">${parseInt(item.total_ocorrencias) + parseInt(item.total_veiculos) + parseInt(item.total_objetos) + parseInt(item.total_telefones)}</td><td class="py-3 px-4 text-center">${item.total_pessoas}</td><td class="py-3 px-4 text-center"><button onclick="abrirModalDetalhesCaso(${item.id})" class="bg-blue-500 text-white font-bold py-1 px-2 rounded text-xs">Detalhes</button><button onclick="abrirModalEdicaoCaso(${item.id})" class="bg-yellow-500 text-white font-bold py-1 px-2 rounded text-xs ml-2">Editar</button><button onclick="abrirModalExclusaoCaso(${item.id}, '${item.inquerito_policial||'ID '+item.id}')" class="bg-red-600 text-white font-bold py-1 px-2 rounded text-xs ml-2">Excluir</button></td>`;
            listaCasos.appendChild(tr);
        });
    } else {
        listaCasos.innerHTML = '<tr><td colspan="6" class="text-center p-8">Nenhum caso criado.</td></tr>';
    }
}

async function abrirModalDetalhesCaso(id) {
    const content = document.getElementById('case-details-content');
    content.innerHTML = '<p>Carregando...</p>';
    toggleModal('case-details-modal', true);
    const response = await fetch(`${API_URL}?action=getCasoDetails&id=${id}`);
    const data = await response.json();
    if (data && data.caso) {
        const caso = data.caso;
        let html = `<div class="space-y-2 mb-4"><p><strong>ID do Caso:</strong> ${caso.id}</p><p><strong>Nº Inquérito:</strong> ${caso.inquerito_policial || 'N/A'}</p><p><strong>Relato:</strong> ${caso.relato_fatos || 'N/A'}</p></div>`;
        const sections = {
            'Pessoas Vinculadas': data.pessoas.map(p => `<li><strong>${p.nome_completo}</strong> (Atuação: ${p.atuacao})</li>`),
            'Ocorrências Vinculadas': data.ocorrencias.map(o => `<li>BO ${o.numero_bo}</li>`),
            'Veículos Vinculados': data.veiculos.map(v => `<li>Placa ${v.placa} (${v.marca_modelo})</li>`),
            'Objetos Vinculados': data.objetos.map(o => `<li>${o.tipo} - ${o.marca || ''}</li>`),
            'Telefones Vinculados': data.telefones.map(t => `<li>${t.numero}</li>`),
        };
        for (const [title, items] of Object.entries(sections)) {
            html += `<hr class="my-3"><h4 class="font-semibold mt-2 mb-1">${title}:</h4>`;
            if (items.length > 0) {
                html += '<ul class="list-disc pl-5 text-sm space-y-1">' + items.join('') + '</ul>';
            } else {
                html += '<p class="text-sm text-gray-500">Nenhum item vinculado.</p>';
            }
        }
        content.innerHTML = html;
    }
}

function abrirModalExclusaoCaso(id, inquerito) {
    document.getElementById('delete-case-message').textContent = `Deseja excluir o caso do Inquérito Nº ${inquerito}?`;
    confirmDeleteCaseBtn.dataset.id = id;
    toggleModal('delete-case-modal', true);
}

async function excluirCaso() {
    const id = confirmDeleteCaseBtn.dataset.id;
    const response = await fetch(`${API_URL}?action=deleteCaso`, { method: 'POST', body: JSON.stringify({ id: id }) });
    const result = await response.json();
    if (result.success) { toggleModal('delete-case-modal', false); carregarCasos(); } else { alert('Erro: ' + result.message); }
}

async function abrirModalEdicaoCaso(id) {
    formEditCaso.reset();
    const response = await fetch(`${API_URL}?action=getCasoDetails&id=${id}`);
    const data = await response.json();
    if (data && data.caso) {
        const caso = data.caso;
        document.getElementById('edit_caso_id').value = caso.id;
        document.getElementById('edit_inquerito_policial').value = caso.inquerito_policial;
        document.getElementById('edit_autos').value = caso.autos;
        document.getElementById('edit_relato_fatos').value = caso.relato_fatos;
        linkedPessoasEdit = data.pessoas; renderPessoasList(true);
        linkedOcorrenciasEdit = data.ocorrencias; renderLinkedList('edit-linked-ocorrencias-list', linkedOcorrenciasEdit, 'removeOcorrenciaEdit', item => `BO: ${item.numero_bo}`);
        linkedVeiculosEdit = data.veiculos; renderLinkedList('edit-linked-veiculos-list', linkedVeiculosEdit, 'removeVeiculoEdit', item => `Placa: ${item.placa || 'N/A'}`);
        linkedObjetosEdit = data.objetos; renderLinkedList('edit-linked-objetos-list', linkedObjetosEdit, 'removeObjetoEdit', item => `${item.tipo} - ${item.marca||''}`);
        linkedTelefonesEdit = data.telefones; renderLinkedList('edit-linked-telefones-list', linkedTelefonesEdit, 'removeTelefoneEdit', item => item.numero);
        toggleModal('edit-case-modal', true);
    }
}

async function salvarAdicaoCaso(e) {
    e.preventDefault();
    const pessoasComAtuacao = Array.from(document.querySelectorAll('#linked-pessoas-list select')).map(select => ({ id: select.dataset.pessoaId, atuacao: select.value }));
    const payload = { ...Object.fromEntries(new FormData(e.target).entries()), pessoas: pessoasComAtuacao, ocorrencias: linkedOcorrencias.map(o => o.id), veiculos: linkedVeiculos.map(v => v.id), objetos: linkedObjetos.map(o => o.id), telefones: linkedTelefones.map(t => t.id) };
    const response = await fetch(`${API_URL}?action=addCaso`, { method: 'POST', body: JSON.stringify(payload) });
    const result = await response.json();
    if (result.success) { e.target.reset(); linkedPessoas = []; linkedOcorrencias = []; linkedVeiculos = []; linkedObjetos = []; linkedTelefones = []; renderPessoasList(false); document.getElementById('linked-ocorrencias-list').innerHTML=''; document.getElementById('linked-veiculos-list').innerHTML=''; document.getElementById('linked-objetos-list').innerHTML=''; document.getElementById('linked-telefones-list').innerHTML=''; carregarCasos(); } else { alert('Erro: ' + result.message); }
}

async function salvarEdicaoCaso(e) {
    e.preventDefault();
    const pessoasComAtuacao = Array.from(document.querySelectorAll('#edit-linked-pessoas-list select')).map(select => ({ id: select.dataset.pessoaId, atuacao: select.value }));
    const payload = { ...Object.fromEntries(new FormData(e.target).entries()), pessoas: pessoasComAtuacao, ocorrencias: linkedOcorrenciasEdit.map(o => o.id), veiculos: linkedVeiculosEdit.map(v => v.id), objetos: linkedObjetosEdit.map(o => o.id), telefones: linkedTelefonesEdit.map(t => t.id) };
    const response = await fetch(`${API_URL}?action=updateCaso`, { method: 'POST', body: JSON.stringify(payload) });
    const result = await response.json();
    if (result.success) { toggleModal('edit-case-modal', false); carregarCasos(); } else { alert('Erro ao atualizar: ' + result.message); }
}

// --- Listeners de Eventos ---
document.addEventListener('DOMContentLoaded', () => {
    // Setup para formulário de ADIÇÃO
    setupGenericSearch('search-pessoa', 'search-results-pessoa', 'searchPessoas', addPessoa, item => item.nome_completo);
    setupGenericSearch('search-ocorrencia', 'search-results-ocorrencia', 'searchOcorrencias', addOcorrencia, item => `BO: ${item.numero_bo}`);
    setupGenericSearch('search-veiculo', 'search-results-veiculo', 'searchVeiculos', addVeiculo, item => `Placa: ${item.placa || 'N/A'}`);
    setupGenericSearch('search-objeto', 'search-results-objeto', 'searchObjetos', addObjeto, item => `${item.tipo} - ${item.marca || ''}`);
    setupGenericSearch('search-telefone', 'search-results-telefone', 'searchTelefones', addTelefone, item => item.numero);
    
    // Setup para formulário de EDIÇÃO
    setupGenericSearch('edit-search-pessoa', 'edit-search-results-pessoa', 'searchPessoas', addPessoaEdit, item => item.nome_completo);
    setupGenericSearch('edit-search-ocorrencia', 'edit-search-results-ocorrencia', 'searchOcorrencias', addOcorrenciaEdit, item => `BO: ${item.numero_bo}`);
    setupGenericSearch('edit-search-veiculo', 'edit-search-results-veiculo', 'searchVeiculos', addVeiculoEdit, item => `Placa: ${item.placa || 'N/A'}`);
    setupGenericSearch('edit-search-objeto', 'edit-search-results-objeto', 'searchObjetos', addObjetoEdit, item => `${item.tipo} - ${item.marca || ''}`);
    setupGenericSearch('edit-search-telefone', 'edit-search-results-telefone', 'searchTelefones', addTelefoneEdit, item => item.numero);

    carregarCasos();
    confirmDeleteCaseBtn.addEventListener('click', excluirCaso);
    formAddCaso.addEventListener('submit', salvarAdicaoCaso);
    formEditCaso.addEventListener('submit', salvarEdicaoCaso);
});
</script>
    </script>
</body>
</html>