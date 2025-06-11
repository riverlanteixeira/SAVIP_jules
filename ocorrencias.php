<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Gestão de Ocorrências</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .search-results { max-height: 200px; display: none; }
        .search-results.show { display: block; }
        .modal { display: none; }
        .modal.flex { display: flex; }
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
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Ocorrências</h1>
            <p class="text-gray-500 mt-1">Cadastre, liste, edite e exclua ocorrências.</p>
        </header>
        
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Registrar Nova Ocorrência</h2>
            <form id="form-add-ocorrencia">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-6 mb-6">
                    <div><label for="numero_bo" class="block text-sm font-medium text-gray-700">Nº Boletim de Ocorrência</label><input type="text" id="numero_bo" name="numero_bo" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required></div>
                    <div><label for="data_fato" class="block text-sm font-medium text-gray-700">Data e Hora do Fato</label><input type="datetime-local" id="data_fato" name="data_fato" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required></div>
                    <div class="md:col-span-2"><label for="fatos_comunicados" class="block text-sm font-medium text-gray-700">Natureza</label><select id="fatos_comunicados" name="fatos_comunicados" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required><option value="" disabled selected>Selecione...</option><option value="ROUBO">ROUBO</option><option value="FURTO">FURTO</option><option value="TRÁFICO DE DROGAS">TRÁFICO DE DROGAS</option><option value="ESTELIONATO">ESTELIONATO</option><option value="RECEPTAÇÃO">RECEPTAÇÃO</option><option value="HOMICÍDIO">HOMICÍDIO</option><option value="EXTORSÃO">EXTORSÃO</option><option value="USO DE DOCUMENTO FALSO">USO DE DOCUMENTO FALSO</option><option value="SEQUESTRO E CÁRCERE PRIVADO">SEQUESTRO E CÁRCERE PRIVADO</option><option value="ASSOCIAÇÃO PARA O TRÁFICO DE DROGAS">ASSOCIAÇÃO PARA O TRÁFICO DE DROGAS</option><option value="MOEDA FALSA">MOEDA FALSA</option><option value="POSSE IRREGULAR DE ARMA DE FOGO">POSSE IRREGULAR DE ARMA DE FOGO</option><option value="FRAUDE NO COMÉRCIO">FRAUDE NO COMÉRCIO</option></select></div>
                </div>
                <h3 class="text-lg font-semibold mb-4">Local do Fato</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 border-b pb-6 mb-6">
                    <div><label for="cep" class="block text-sm font-medium text-gray-700">CEP</label><input type="text" id="cep" name="cep" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                    <div class="md:col-span-3"><label for="rua" class="block text-sm font-medium text-gray-700">Rua</label><input type="text" id="rua" name="rua" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required></div>
                    <div><label for="numero" class="block text-sm font-medium text-gray-700">Número</label><input type="text" id="numero" name="numero" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                    <div><label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label><input type="text" id="bairro" name="bairro" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required></div>
                    <div><label for="municipio" class="block text-sm font-medium text-gray-700">Município</label><input type="text" id="municipio" name="municipio" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required></div>
                    <div><label for="uf" class="block text-sm font-medium text-gray-700">UF</label><select id="uf" name="uf" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required><option value="" disabled selected>Selecione</option><option value="AC">Acre</option><option value="AL">Alagoas</option><option value="AP">Amapá</option><option value="AM">Amazonas</option><option value="BA">Bahia</option><option value="CE">Ceará</option><option value="DF">Distrito Federal</option><option value="ES">Espírito Santo</option><option value="GO">Goiás</option><option value="MA">Maranhão</option><option value="MT">Mato Grosso</option><option value="MS">Mato Grosso do Sul</option><option value="MG">Minas Gerais</option><option value="PA">Pará</option><option value="PB">Paraíba</option><option value="PR">Paraná</option><option value="PE">Pernambuco</option><option value="PI">Piauí</option><option value="RJ">Rio de Janeiro</option><option value="RN">Rio Grande do Norte</option><option value="RS">Rio Grande do Sul</option><option value="RO">Rondônia</option><option value="RR">Roraima</option><option value="SC">Santa Catarina</option><option value="SP">São Paulo</option><option value="SE">Sergipe</option><option value="TO">Tocantins</option></select></div>
                </div>
                <h3 class="text-lg font-semibold mb-4">Pessoas Envolvidas</h3>
                <div class="relative mb-4">
                    <label for="search-pessoa" class="block text-sm font-medium text-gray-700">Buscar Pessoa (por nome ou CPF)</label>
                    <input type="text" id="search-pessoa" placeholder="Digite para buscar..." class="mt-1 w-full p-2 border border-gray-300 rounded-md">
                    <div id="search-results" class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg"></div>
                </div>
                <div id="envolvidos-list" class="space-y-4"></div>
                <div class="mt-8 text-right"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar Ocorrência</button></div>
            </form>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
             <h2 class="text-2xl font-semibold mb-6">Ocorrências Registradas</h2>
             <div class="overflow-x-auto">
                <table class="min-w-full bg-white"><thead class="bg-gray-200"><tr><th class="py-3 px-4 text-left text-xs font-semibold uppercase">Nº BO</th><th class="py-3 px-4 text-left text-xs font-semibold uppercase">Natureza</th><th class="py-3 px-4 text-left text-xs font-semibold uppercase">Data</th><th class="py-3 px-4 text-left text-xs font-semibold uppercase">Município</th><th class="py-3 px-4 text-center text-xs font-semibold uppercase">Envolvidos</th><th class="py-3 px-4 text-center text-xs font-semibold uppercase">Ações</th></tr></thead><tbody id="lista-ocorrencias"></tbody></table>
             </div>
        </div>
    </div>
    
    <div id="details-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50"><div class="bg-white w-11/12 md:max-w-2xl mx-auto rounded-lg shadow-lg z-50"><div class="py-4 text-left px-6"><div class="flex justify-between items-center pb-3 border-b"><p class="text-2xl font-bold">Detalhes da Ocorrência</p><div class="cursor-pointer z-50" onclick="toggleModal('details-modal', false)"><span class="text-3xl">&times;</span></div></div><div id="details-content" class="my-4 max-h-[70vh] overflow-y-auto p-2"></div><div class="flex justify-end pt-2 border-t"><button class="px-4 bg-gray-500 p-2 rounded-lg text-white" onclick="toggleModal('details-modal', false)">Fechar</button></div></div></div></div>
    
    <div id="delete-ocorrencia-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50"><div class="bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50"><div class="py-4 text-left px-6"><div class="flex justify-between items-center pb-3"><p class="text-2xl font-bold text-red-600">Confirmar Exclusão</p><div class="cursor-pointer z-50" onclick="toggleModal('delete-ocorrencia-modal', false)"><span class="text-3xl">&times;</span></div></div><p id="delete-ocorrencia-message"></p><div class="flex justify-end pt-4 mt-4 border-t"><button class="px-4 bg-gray-200 p-3 rounded-lg mr-2" onclick="toggleModal('delete-ocorrencia-modal', false)">Cancelar</button><button id="confirm-delete-ocorrencia-btn" class="px-4 bg-red-600 p-3 rounded-lg text-white">Sim, Excluir</button></div></div></div></div>

    <div id="edit-ocorrencia-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-4xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6">
                <div class="flex justify-between items-center pb-3 border-b"><p class="text-2xl font-bold">Editar Ocorrência</p><div class="cursor-pointer z-50" onclick="toggleModal('edit-ocorrencia-modal', false)"><span class="text-3xl">&times;</span></div></div>
                <div class="max-h-[80vh] overflow-y-auto p-4">
                    <form id="form-edit-ocorrencia">
                        <input type="hidden" id="edit_ocorrencia_id" name="id">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b pb-6 mb-6">
                            <div><label for="edit_numero_bo" class="block text-sm font-medium">Nº BO</label><input type="text" id="edit_numero_bo" name="numero_bo" class="mt-1 w-full p-2 border rounded" required></div>
                            <div><label for="edit_data_fato" class="block text-sm font-medium">Data do Fato</label><input type="datetime-local" id="edit_data_fato" name="data_fato" class="mt-1 w-full p-2 border rounded" required></div>
                            <div class="md:col-span-2"><label for="edit_fatos_comunicados" class="block text-sm font-medium">Natureza</label><select id="edit_fatos_comunicados" name="fatos_comunicados" class="mt-1 w-full p-2 border rounded" required><option value="ROUBO">ROUBO</option><option value="FURTO">FURTO</option><option value="TRÁFICO DE DROGAS">TRÁFICO DE DROGAS</option><option value="ESTELIONATO">ESTELIONATO</option><option value="RECEPTAÇÃO">RECEPTAÇÃO</option><option value="HOMICÍDIO">HOMICÍDIO</option><option value="EXTORSÃO">EXTORSÃO</option><option value="USO DE DOCUMENTO FALSO">USO DE DOCUMENTO FALSO</option><option value="SEQUESTRO E CÁRCERE PRIVADO">SEQUESTRO E CÁRCERE PRIVADO</option><option value="ASSOCIAÇÃO PARA O TRÁFICO DE DROGAS">ASSOCIAÇÃO PARA O TRÁFICO DE DROGAS</option><option value="MOEDA FALSA">MOEDA FALSA</option><option value="POSSE IRREGULAR DE ARMA DE FOGO">POSSE IRREGULAR DE ARMA DE FOGO</option><option value="FRAUDE NO COMÉRCIO">FRAUDE NO COMÉRCIO</option></select></div>
                        </div>
                        <h3 class="text-lg font-semibold mb-4">Local do Fato</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 border-b pb-6 mb-6">
                            <div><label for="edit_cep" class="block text-sm font-medium">CEP</label><input type="text" id="edit_cep" name="cep" class="mt-1 w-full p-2 border rounded"></div>
                            <div class="md:col-span-3"><label for="edit_rua" class="block text-sm font-medium">Rua</label><input type="text" id="edit_rua" name="rua" class="mt-1 w-full p-2 border rounded" required></div>
                            <div><label for="edit_numero" class="block text-sm font-medium">Número</label><input type="text" id="edit_numero" name="numero" class="mt-1 w-full p-2 border rounded"></div>
                            <div><label for="edit_bairro" class="block text-sm font-medium">Bairro</label><input type="text" id="edit_bairro" name="bairro" class="mt-1 w-full p-2 border rounded" required></div>
                            <div><label for="edit_municipio" class="block text-sm font-medium">Município</label><input type="text" id="edit_municipio" name="municipio" class="mt-1 w-full p-2 border rounded" required></div>
                            <div><label for="edit_uf" class="block text-sm font-medium">UF</label><select id="edit_uf" name="uf" class="mt-1 w-full p-2 border rounded" required><option value="AC">Acre</option><option value="AL">Alagoas</option><option value="AP">Amapá</option><option value="AM">Amazonas</option><option value="BA">Bahia</option><option value="CE">Ceará</option><option value="DF">Distrito Federal</option><option value="ES">Espírito Santo</option><option value="GO">Goiás</option><option value="MA">Maranhão</option><option value="MT">Mato Grosso</option><option value="MS">Mato Grosso do Sul</option><option value="MG">Minas Gerais</option><option value="PA">Pará</option><option value="PB">Paraíba</option><option value="PR">Paraná</option><option value="PE">Pernambuco</option><option value="PI">Piauí</option><option value="RJ">Rio de Janeiro</option><option value="RN">Rio Grande do Norte</option><option value="RS">Rio Grande do Sul</option><option value="RO">Rondônia</option><option value="RR">Roraima</option><option value="SC">Santa Catarina</option><option value="SP">São Paulo</option><option value="SE">Sergipe</option><option value="TO">Tocantins</option></select></div>
                        </div>
                        <h3 class="text-lg font-semibold mb-4">Pessoas Envolvidas</h3>
                        <div class="relative mb-4">
                            <label for="edit-search-pessoa" class="block text-sm font-medium">Buscar Pessoa</label><input type="text" id="edit-search-pessoa" placeholder="Digite para buscar..." class="mt-1 w-full p-2 border rounded">
                            <div id="edit-search-results" class="search-results absolute z-20 w-full bg-white border mt-1 rounded shadow-lg"></div>
                        </div>
                        <div id="edit_envolvidos-list" class="space-y-4"></div>
                        <div class="flex justify-end pt-4 mt-4 border-t"><button type="button" class="px-4 bg-gray-200 p-3 rounded-lg mr-2" onclick="toggleModal('edit-ocorrencia-modal', false)">Cancelar</button><button type="submit" class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Alterações</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = 'api.php';
        let envolvidos = [], envolvidosEdit = [];

        const formAddOcorrencia = document.getElementById('form-add-ocorrencia');
        const formEditOcorrencia = document.getElementById('form-edit-ocorrencia');
        const confirmDeleteOcorrenciaBtn = document.getElementById('confirm-delete-ocorrencia-btn');

        function toggleModal(modalId, show) {
            const modal = document.getElementById(modalId);
            if (show) modal.classList.add('flex');
            else modal.classList.remove('flex');
        }

        function setupGenericSearch(inputId, resultsId, searchAction, addFunction, getLabel) {
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
                        div.onclick = () => { addFunction(item); searchInput.value = ''; searchResults.classList.remove('show'); };
                        searchResults.appendChild(div);
                    });
                    searchResults.classList.add('show');
                }
            });
        }

        function addEnvolvido(p) { if (!envolvidos.find(i => i.id === p.id)) { envolvidos.push(p); renderEnvolvidos(); } }
        function removeEnvolvido(index) { envolvidos.splice(index, 1); renderEnvolvidos(); }
        function renderEnvolvidos() {
            const listEl = document.getElementById('envolvidos-list');
            listEl.innerHTML = '';
            envolvidos.forEach((p, i) => {
                const div = document.createElement('div');
                div.className = 'p-2 border rounded flex justify-between items-center bg-gray-50';
                div.innerHTML = `<span>${p.nome_completo}</span><div><label class="text-sm mr-2">Participação:</label><select class="p-1 border rounded mr-4" data-pessoa-id="${p.id}"><option>Suspeito</option><option>Vítima</option><option>Testemunha</option><option>Outro</option></select><button type="button" onclick="removeEnvolvido(${i})" class="text-red-500 font-bold">X</button></div>`;
                listEl.appendChild(div);
            });
        }

        function addEnvolvidoEdit(p) { if (!envolvidosEdit.find(i => i.id === p.id)) { envolvidosEdit.push({ ...p, participacao: 'Suspeito' }); renderEnvolvidosEdit(); } }
        function removeEnvolvidoEdit(index) { envolvidosEdit.splice(index, 1); renderEnvolvidosEdit(); }
        function renderEnvolvidosEdit() {
            const listEl = document.getElementById('edit_envolvidos-list');
            listEl.innerHTML = '';
            envolvidosEdit.forEach((p, i) => {
                const div = document.createElement('div');
                div.className = 'p-2 border rounded flex justify-between items-center bg-gray-50';
                div.innerHTML = `<span>${p.nome_completo}</span><div><label class="text-sm mr-2">Participação:</label><select class="p-1 border rounded mr-4" data-pessoa-id="${p.id}"><option ${p.participacao === 'Suspeito' ? 'selected' : ''}>Suspeito</option><option ${p.participacao === 'Vítima' ? 'selected' : ''}>Vítima</option><option ${p.participacao === 'Testemunha' ? 'selected' : ''}>Testemunha</option><option ${p.participacao === 'Outro' ? 'selected' : ''}>Outro</option></select><button type="button" onclick="removeEnvolvidoEdit(${i})" class="text-red-500 font-bold">X</button></div>`;
                listEl.appendChild(div);
            });
        }

        async function carregarOcorrencias() {
            const response = await fetch(`${API_URL}?action=getOcorrencias`);
            const ocorrencias = await response.json();
            const listaOcorrencias = document.getElementById('lista-ocorrencias');
            listaOcorrencias.innerHTML = '';
            if (ocorrencias.length > 0) {
                ocorrencias.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.className = 'border-b hover:bg-gray-50';
                    tr.innerHTML = `<td class="py-3 px-4">${item.numero_bo}</td><td class="py-3 px-4">${item.fatos_comunicados}</td><td class="py-3 px-4">${new Date(item.data_fato).toLocaleString('pt-BR')}</td><td class="py-3 px-4">${item.municipio}-${item.uf}</td><td class="py-3 px-4 text-center">${item.total_envolvidos}</td><td class="py-3 px-4 text-center"><button onclick="abrirModalDetalhes(${item.id})" class="bg-blue-500 text-white font-bold py-1 px-2 rounded text-xs">Detalhes</button><button onclick="abrirModalEdicaoOcorrencia(${item.id})" class="bg-yellow-500 text-white font-bold py-1 px-2 rounded text-xs ml-2">Editar</button><button onclick="abrirModalExclusaoOcorrencia(${item.id},'${item.numero_bo}')" class="bg-red-600 text-white font-bold py-1 px-2 rounded text-xs ml-2">Excluir</button></td>`;
                    listaOcorrencias.appendChild(tr);
                });
            }
        }

        async function abrirModalDetalhes(id) {
            const content = document.getElementById('details-content');
            content.innerHTML = '<p>Carregando...</p>';
            toggleModal('details-modal', true);
            const response = await fetch(`${API_URL}?action=getOcorrenciaDetails&id=${id}`);
            const data = await response.json();
            if (data && data.ocorrencia) {
                let html = `<p><strong>BO:</strong> ${data.ocorrencia.numero_bo}</p><p><strong>Fato:</strong> ${data.ocorrencia.fatos_comunicados}</p><h4 class="font-semibold mt-2">Envolvidos:</h4>`;
                if (data.envolvidos.length > 0) { html += '<ul class="list-disc pl-5">'; data.envolvidos.forEach(p => { html += `<li>${p.nome_completo} (${p.participacao})</li>`; }); html += '</ul>'; }
                content.innerHTML = html;
            }
        }
        
        async function abrirModalEdicaoOcorrencia(id) {
            formEditOcorrencia.reset();
            const response = await fetch(`${API_URL}?action=getOcorrenciaDetails&id=${id}`);
            const data = await response.json();
            if (data && data.ocorrencia) {
                const occ = data.ocorrencia;
                document.getElementById('edit_ocorrencia_id').value = occ.id;
                document.getElementById('edit_numero_bo').value = occ.numero_bo;
                document.getElementById('edit_data_fato').value = new Date(occ.data_fato).toISOString().slice(0, 16);
                document.getElementById('edit_fatos_comunicados').value = occ.fatos_comunicados;
                document.getElementById('edit_cep').value = occ.cep;
                document.getElementById('edit_rua').value = occ.rua;
                document.getElementById('edit_numero').value = occ.numero;
                document.getElementById('edit_bairro').value = occ.bairro;
                document.getElementById('edit_municipio').value = occ.municipio;
                document.getElementById('edit_uf').value = occ.uf;
                envolvidosEdit = data.envolvidos;
                renderEnvolvidosEdit();
                toggleModal('edit-ocorrencia-modal', true);
            }
        }

        function abrirModalExclusaoOcorrencia(id, numero_bo) {
            document.getElementById('delete-ocorrencia-message').textContent = `Deseja excluir a ocorrência BO nº ${numero_bo}?`;
            confirmDeleteOcorrenciaBtn.dataset.id = id;
            toggleModal('delete-ocorrencia-modal', true);
        }

        async function excluirOcorrencia() {
            const id = confirmDeleteOcorrenciaBtn.dataset.id;
            const response = await fetch(`${API_URL}?action=deleteOcorrencia`, { method: 'POST', body: JSON.stringify({ id: id }) });
            const result = await response.json();
            if (result.success) { toggleModal('delete-ocorrencia-modal', false); carregarOcorrencias(); } else { alert('Erro: ' + result.message); }
        }

        async function salvarAdicaoOcorrencia(e) {
            e.preventDefault();
            const participacaoSelects = document.querySelectorAll('#envolvidos-list select');
            const envolvidosData = envolvidos.map((pessoa, index) => ({ id: pessoa.id, participacao: participacaoSelects[index].value }));
            const payload = { ...Object.fromEntries(new FormData(e.target).entries()), envolvidos: envolvidosData };
            const response = await fetch(`${API_URL}?action=addOcorrencia`, { method: 'POST', body: JSON.stringify(payload) });
            const result = await response.json();
            if (result.success) { e.target.reset(); envolvidos = []; renderEnvolvidos(); carregarOcorrencias(); } else { alert('Erro: ' + result.message); }
        }

        async function salvarEdicaoOcorrencia(e) {
            e.preventDefault();
            const participacaoSelects = document.querySelectorAll('#edit_envolvidos-list select');
            const envolvidosData = envolvidosEdit.map((pessoa, index) => ({ id: pessoa.id, participacao: participacaoSelects[index].value }));
            const payload = { ...Object.fromEntries(new FormData(e.target).entries()), envolvidos: envolvidosData };
            const response = await fetch(`${API_URL}?action=updateOcorrencia`, { method: 'POST', body: JSON.stringify(payload) });
            const result = await response.json();
            if (result.success) { toggleModal('edit-ocorrencia-modal', false); carregarOcorrencias(); } else { alert('Erro ao atualizar: ' + result.message); }
        }

        document.addEventListener('DOMContentLoaded', () => {
            setupGenericSearch('search-pessoa', 'search-results', 'searchPessoas', addEnvolvido, item => item.nome_completo);
            setupGenericSearch('edit-search-pessoa', 'edit-search-results', 'searchPessoas', addEnvolvidoEdit, item => item.nome_completo);
            carregarOcorrencias();
            confirmDeleteOcorrenciaBtn.addEventListener('click', excluirOcorrencia);
            formAddOcorrencia.addEventListener('submit', salvarAdicaoOcorrencia);
            formEditOcorrencia.addEventListener('submit', salvarEdicaoOcorrencia);
        });
    </script>
</body>
</html>