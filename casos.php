<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Gestão de Casos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .search-results {
            max-height: 150px;
            display: none;
        }

        .search-results.show {
            display: block;
        }

        .modal {
            display: none;
        }

        .modal.flex {
            display: flex;
        }
    </style>
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
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Gestão de Casos</h1>
            <p class="text-gray-500 mt-1">Crie, gerencie e edite os dossiês das suas investigações.</p>
        </header>

        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Criar Novo Caso</h2>
            <form id="form-add-caso">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informações do Caso</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-4">
                    <div><label for="inquerito_policial" class="block text-sm font-medium">Nº Inquérito</label><input
                            type="text" id="inquerito_policial" name="inquerito_policial"
                            class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="autos" class="block text-sm font-medium">Nº Autos</label><input type="text"
                            id="autos" name="autos" class="mt-1 w-full p-2 border rounded"></div>
                    <div class="md:col-span-2">
                        <label for="relato_fatos" class="block text-sm font-medium">Relato dos Fatos</label>
                        <textarea id="relato_fatos" name="relato_fatos" rows="4"
                            class="mt-1 w-full p-2 border rounded"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="investigacoes" class="block text-sm font-medium">Das Investigações
                            (Diligências)</label>
                        <textarea id="investigacoes" name="investigacoes" rows="4"
                            class="mt-1 w-full p-2 border rounded"></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="conclusao" class="block text-sm font-medium">Conclusão do Caso</label>
                        <textarea id="conclusao" name="conclusao" rows="4"
                            class="mt-1 w-full p-2 border rounded"></textarea>
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-4 mt-8 border-b pb-2">Vincular Entidades ao Caso</h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8">
                    <div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Pessoa</label>
                            <div class="relative"><input type="text" id="search-pessoa" placeholder="Nome ou CPF..."
                                    class="mt-1 w-full p-2 border rounded">
                                <div id="search-results-pessoa"
                                    class="search-results absolute z-20 w-full bg-white border mt-1 rounded shadow-lg">
                                </div>
                            </div>
                            <div id="linked-pessoas-list" class="mt-2 space-y-2"></div>
                        </div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Veículo</label>
                            <div class="relative"><input type="text" id="search-veiculo"
                                    placeholder="Placa ou modelo..." class="mt-1 w-full p-2 border rounded">
                                <div id="search-results-veiculo"
                                    class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                </div>
                            </div>
                            <div id="linked-veiculos-list" class="mt-2 space-y-2"></div>
                        </div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Telefone</label>
                            <div class="relative"><input type="text" id="search-telefone"
                                    placeholder="Número ou IMEI..." class="mt-1 w-full p-2 border rounded">
                                <div id="search-results-telefone"
                                    class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                </div>
                            </div>
                            <div id="linked-telefones-list" class="mt-2 space-y-2"></div>
                        </div>
                    </div>
                    <div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Ocorrência</label>
                            <div class="relative"><input type="text" id="search-ocorrencia"
                                    placeholder="Número do BO..." class="mt-1 w-full p-2 border rounded">
                                <div id="search-results-ocorrencia"
                                    class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                </div>
                            </div>
                            <div id="linked-ocorrencias-list" class="mt-2 space-y-2"></div>
                        </div>
                        <div class="my-4"><label class="block text-sm font-medium">Buscar Objeto</label>
                            <div class="relative"><input type="text" id="search-objeto" placeholder="Tipo ou marca..."
                                    class="mt-1 w-full p-2 border rounded">
                                <div id="search-results-objeto"
                                    class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                </div>
                            </div>
                            <div id="linked-objetos-list" class="mt-2 space-y-2"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-right"><button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar Novo
                        Caso</button></div>
            </form>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-6">Casos Abertos</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left uppercase text-xs font-semibold">ID</th>
                            <th class="py-3 px-4 text-left uppercase text-xs font-semibold">Nº Inquérito</th>
                            <th class="py-3 px-4 text-left uppercase text-xs font-semibold">Data Criação</th>
                            <th class="py-3 px-4 text-center uppercase text-xs font-semibold">Vínculos</th>
                            <th class="py-3 px-4 text-center uppercase text-xs font-semibold">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="lista-casos"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="case-details-modal"
        class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-3xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Detalhes do Caso</p>
                    <div class="cursor-pointer z-50" onclick="toggleModal('case-details-modal', false)"><span
                            class="text-3xl">&times;</span></div>
                </div>
                <div id="case-details-content" class="my-4 max-h-[70vh] overflow-y-auto p-2"></div>
                <div class="flex justify-end pt-2 border-t"><button
                        class="px-4 bg-gray-500 p-2 rounded-lg text-white hover:bg-gray-600"
                        onclick="toggleModal('case-details-modal', false)">Fechar</button></div>
            </div>
        </div>
    </div>
    <div id="delete-case-modal"
        class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold text-red-600">Confirmar Exclusão</p>
                    <div class="cursor-pointer z-50" onclick="toggleModal('delete-case-modal', false)"><span
                            class="text-3xl">&times;</span></div>
                </div>
                <p id="delete-case-message"></p>
                <div class="flex justify-end pt-4 mt-4 border-t"><button class="px-4 bg-gray-200 p-3 rounded-lg mr-2"
                        onclick="toggleModal('delete-case-modal', false)">Cancelar</button><button
                        id="confirm-delete-case-btn" class="px-4 bg-red-600 p-3 rounded-lg text-white">Sim,
                        Excluir</button></div>
            </div>
        </div>
    </div>
    <div id="edit-case-modal"
        class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-4xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Editar Caso</p>
                    <div class="cursor-pointer z-50" onclick="toggleModal('edit-case-modal', false)"><span
                            class="text-3xl">&times;</span></div>
                </div>
                <div class="max-h-[80vh] overflow-y-auto p-4">
                    <form id="form-edit-caso"><input type="hidden" id="edit_caso_id" name="id">
                        <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informações do Caso</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-4">
                            <div><label for="edit_inquerito_policial" class="block text-sm font-medium">Nº
                                    Inquérito</label><input type="text" id="edit_inquerito_policial"
                                    name="inquerito_policial" class="mt-1 w-full p-2 border rounded"></div>
                            <div><label for="edit_autos" class="block text-sm font-medium">Nº Autos</label><input
                                    type="text" id="edit_autos" name="autos" class="mt-1 w-full p-2 border rounded">
                            </div>
                            <div class="md:col-span-2">
                                <label for="edit_relato_fatos" class="block text-sm font-medium">Relato dos
                                    Fatos</label>
                                <textarea id="edit_relato_fatos" name="relato_fatos" rows="4"
                                    class="mt-1 w-full p-2 border rounded"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label for="edit_investigacoes" class="block text-sm font-medium">Das Investigações
                                    (Diligências)</label>
                                <textarea id="edit_investigacoes" name="investigacoes" rows="4"
                                    class="mt-1 w-full p-2 border rounded"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label for="edit_conclusao" class="block text-sm font-medium">Conclusão do Caso</label>
                                <textarea id="edit_conclusao" name="conclusao" rows="4"
                                    class="mt-1 w-full p-2 border rounded"></textarea>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold mb-4 mt-8 border-b pb-2">Vincular Entidades ao Caso</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8">
                            <div>
                                <div class="my-4"><label class="block text-sm font-medium">Buscar Pessoa</label>
                                    <div class="relative"><input type="text" id="edit-search-pessoa"
                                            placeholder="Nome ou CPF..." class="mt-1 w-full p-2 border rounded">
                                        <div id="edit-search-results-pessoa"
                                            class="search-results absolute z-20 w-full bg-white border mt-1 rounded shadow-lg">
                                        </div>
                                    </div>
                                    <div id="edit-linked-pessoas-list" class="mt-2 space-y-2"></div>
                                </div>
                                <div class="my-4"><label class="block text-sm font-medium">Buscar Veículo</label>
                                    <div class="relative"><input type="text" id="edit-search-veiculo"
                                            placeholder="Placa ou modelo..." class="mt-1 w-full p-2 border rounded">
                                        <div id="edit-search-results-veiculo"
                                            class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                        </div>
                                    </div>
                                    <div id="edit-linked-veiculos-list" class="mt-2 space-y-2"></div>
                                </div>
                                <div class="my-4"><label class="block text-sm font-medium">Buscar Telefone</label>
                                    <div class="relative"><input type="text" id="edit-search-telefone"
                                            placeholder="Número ou IMEI..." class="mt-1 w-full p-2 border rounded">
                                        <div id="edit-search-results-telefone"
                                            class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                        </div>
                                    </div>
                                    <div id="edit-linked-telefones-list" class="mt-2 space-y-2"></div>
                                </div>
                            </div>
                            <div>
                                <div class="my-4"><label class="block text-sm font-medium">Buscar Ocorrência</label>
                                    <div class="relative"><input type="text" id="edit-search-ocorrencia"
                                            placeholder="Número do BO..." class="mt-1 w-full p-2 border rounded">
                                        <div id="edit-search-results-ocorrencia"
                                            class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                        </div>
                                    </div>
                                    <div id="edit-linked-ocorrencias-list" class="mt-2 space-y-2"></div>
                                </div>
                                <div class="my-4"><label class="block text-sm font-medium">Buscar Objeto</label>
                                    <div class="relative"><input type="text" id="edit-search-objeto"
                                            placeholder="Tipo ou marca..." class="mt-1 w-full p-2 border rounded">
                                        <div id="edit-search-results-objeto"
                                            class="search-results absolute z-10 w-full bg-white border mt-1 rounded shadow-lg">
                                        </div>
                                    </div>
                                    <div id="edit-linked-objetos-list" class="mt-2 space-y-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end pt-4 mt-4 border-t"><button type="button"
                                class="px-4 bg-gray-200 p-3 rounded-lg mr-2"
                                onclick="toggleModal('edit-case-modal', false)">Cancelar</button><button type="submit"
                                class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Alterações</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = 'api.php';
        // Removidas as arrays globais individuais, serão gerenciadas pelo linkedItemsManager

        const formAddCaso = document.getElementById('form-add-caso');
        const formEditCaso = document.getElementById('form-edit-caso');
        const confirmDeleteCaseBtn = document.getElementById('confirm-delete-case-btn');

        function toggleModal(modalId, show) { const modal = document.getElementById(modalId); if (show) modal.classList.add('flex'); else modal.classList.remove('flex'); }
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

        const linkedItemsManager = {
            data: {
                add: { pessoa: [], ocorrencia: [], veiculo: [], objeto: [], telefone: [] },
                edit: { pessoa: [], ocorrencia: [], veiculo: [], objeto: [], telefone: [] }
            },
            listElementIds: {
                add: {
                    pessoa: 'linked-pessoas-list', ocorrencia: 'linked-ocorrencias-list',
                    veiculo: 'linked-veiculos-list', objeto: 'linked-objetos-list', telefone: 'linked-telefones-list'
                },
                edit: {
                    pessoa: 'edit-linked-pessoas-list', ocorrencia: 'edit-linked-ocorrencias-list',
                    veiculo: 'edit-linked-veiculos-list', objeto: 'edit-linked-objetos-list', telefone: 'edit-linked-telefones-list'
                }
            },
            itemRenderers: {
                pessoa: (pessoa, mode, index) => {
                    const removeFn = `linkedItemsManager.removeItem('${mode}', 'pessoa', ${index})`;
                    return `<span>${escapeHTML(pessoa.nome_completo)}</span>
                            <div>
                                <label class="text-sm mr-2">Atuação:</label>
                                <select class="p-1 border rounded mr-4" data-pessoa-id="${pessoa.id}" data-mode="${mode}" data-type="pessoa" data-index="${index}" onchange="linkedItemsManager.updatePessoaAtuacao(this)">
                                    <option ${pessoa.atuacao === 'Suspeito' ? 'selected' : ''}>Suspeito</option>
                                    <option ${pessoa.atuacao === 'Autor' ? 'selected' : ''}>Autor</option>
                                    <option ${pessoa.atuacao === 'Vítima' ? 'selected' : ''}>Vítima</option>
                                    <option ${pessoa.atuacao === 'Testemunha' ? 'selected' : ''}>Testemunha</option>
                                    <option ${pessoa.atuacao === 'Outro' ? 'selected' : ''}>Outro</option>
                                </select>
                                <button type="button" onclick="${removeFn}" class="text-red-500 font-bold px-2">X</button>
                            </div>`;
                },
                ocorrencia: (item, mode, index) => {
                    const removeFn = `linkedItemsManager.removeItem('${mode}', 'ocorrencia', ${index})`;
                    return `<span>BO: ${escapeHTML(item.numero_bo)}</span>
                            <button type="button" onclick="${removeFn}" class="text-red-500 font-bold px-2">X</button>`;
                },
                veiculo: (item, mode, index) => {
                    const removeFn = `linkedItemsManager.removeItem('${mode}', 'veiculo', ${index})`;
                    return `<span>Placa: ${escapeHTML(item.placa || 'N/A')}</span>
                            <button type="button" onclick="${removeFn}" class="text-red-500 font-bold px-2">X</button>`;
                },
                objeto: (item, mode, index) => {
                    const removeFn = `linkedItemsManager.removeItem('${mode}', 'objeto', ${index})`;
                    return `<span>${escapeHTML(item.tipo)} - ${escapeHTML(item.marca || '')}</span>
                            <button type="button" onclick="${removeFn}" class="text-red-500 font-bold px-2">X</button>`;
                },
                telefone: (item, mode, index) => {
                    const removeFn = `linkedItemsManager.removeItem('${mode}', 'telefone', ${index})`;
                    return `<span>${escapeHTML(item.numero)}</span>
                            <button type="button" onclick="${removeFn}" class="text-red-500 font-bold px-2">X</button>`;
                }
            },
            addItem: function (mode, type, item) {
                if (!this.data[mode][type].find(i => i.id === item.id)) {
                    if (type === 'pessoa' && !item.atuacao) item.atuacao = 'Suspeito'; // Default 'atuacao'
                    this.data[mode][type].push(item);
                    this.renderItems(mode, type);
                }
            },
            removeItem: function (mode, type, index) {
                this.data[mode][type].splice(index, 1);
                this.renderItems(mode, type);
            },
            renderItems: function(mode, type) {
    const listElementId = this.listElementIds[mode][type];
    if (!listElementId) { console.error(`List element ID not found for ${mode}, ${type}`); return; }
    const listElement = document.getElementById(listElementId);
    if (!listElement) { console.error(`List element not found in DOM: ${listElementId}`); return; }

    listElement.innerHTML = '';
    this.data[mode][type].forEach((item, index) => {
        const div = document.createElement('div');
        div.className = 'p-2 border rounded flex justify-between items-center text-sm bg-gray-50';
        
        // LINHA CORRIGIDA:
        div.innerHTML = this.itemRenderers[type](item, mode, index);
        
        listElement.appendChild(div);
    });
},
            updatePessoaAtuacao: function (selectElement) {
                const mode = selectElement.dataset.mode;
                const type = selectElement.dataset.type;
                const index = parseInt(selectElement.dataset.index);
                const pessoaId = parseInt(selectElement.dataset.pessoaId);

                if (this.data[mode][type][index] && this.data[mode][type][index].id === pessoaId) {
                    this.data[mode][type][index].atuacao = selectElement.value;
                }
            },
            reset: function (mode) {
                for (const type in this.data[mode]) {
                    this.data[mode][type] = [];
                    this.renderItems(mode, type);
                }
            },
            loadForEdit: function (caseData) {
                this.reset('edit');
                if (caseData.pessoas) caseData.pessoas.forEach(p => this.addItem('edit', 'pessoa', p));
                if (caseData.ocorrencias) caseData.ocorrencias.forEach(o => this.addItem('edit', 'ocorrencia', o));
                if (caseData.veiculos) caseData.veiculos.forEach(v => this.addItem('edit', 'veiculo', v));
                if (caseData.objetos) caseData.objetos.forEach(o => this.addItem('edit', 'objeto', o));
                if (caseData.telefones) caseData.telefones.forEach(t => this.addItem('edit', 'telefone', t));
            },
            getPayloadData: function (mode) {
                const payload = {};
                payload.pessoas = this.data[mode].pessoa.map(p => ({ id: p.id, atuacao: p.atuacao }));
                payload.ocorrencias = this.data[mode].ocorrencia.map(o => o.id);
                payload.veiculos = this.data[mode].veiculo.map(v => v.id);
                payload.objetos = this.data[mode].objeto.map(o => o.id);
                payload.telefones = this.data[mode].telefone.map(t => t.id);
                return payload;
            }
        };

        async function carregarCasos() { const response = await fetch(`${API_URL}?action=getCasos`); const casos = await response.json(); const listaCasos = document.getElementById('lista-casos'); listaCasos.innerHTML = ''; if (casos.length > 0) { casos.forEach(item => { const tr = document.createElement('tr'); tr.className = 'border-b hover:bg-gray-50'; const totalVinculos = parseInt(item.total_ocorrencias) + parseInt(item.total_pessoas) + parseInt(item.total_veiculos) + parseInt(item.total_objetos) + parseInt(item.total_telefones); tr.innerHTML = `<td class="py-3 px-4">${item.id}</td><td class="py-3 px-4">${item.inquerito_policial || 'N/A'}</td><td class="py-3 px-4">${new Date(item.data_criacao).toLocaleDateString('pt-BR')}</td><td class="py-3 px-4 text-center">${totalVinculos}</td><td class="py-3 px-4 text-center"><a href="gerar_dossie_caso.php?id=${item.id}" target="_blank" class="bg-green-600 text-white font-bold py-1 px-2 rounded text-xs">Dossiê</a><button onclick="abrirModalDetalhesCaso(${item.id})" class="bg-blue-500 text-white font-bold py-1 px-2 rounded text-xs ml-2">Detalhes</button><button onclick="abrirModalEdicaoCaso(${item.id})" class="bg-yellow-500 text-white font-bold py-1 px-2 rounded text-xs ml-2">Editar</button><button onclick="abrirModalExclusaoCaso(${item.id}, '${item.inquerito_policial || 'ID ' + item.id}')" class="bg-red-600 text-white font-bold py-1 px-2 rounded text-xs ml-2">Excluir</button></td>`; listaCasos.appendChild(tr); }); } else { listaCasos.innerHTML = '<tr><td colspan="5" class="text-center p-8">Nenhum caso criado.</td></tr>'; } }
        async function abrirModalDetalhesCaso(id) {
    const content = document.getElementById('case-details-content');
    content.innerHTML = '<p>Carregando...</p>';
    toggleModal('case-details-modal', true);
    
    const response = await fetch(`${API_URL}?action=getCasoDetails&id=${id}`);
    const data = await response.json();

    if (data && data.caso) {
        const caso = data.caso;
        let html = `<div class="space-y-3 mb-4 text-sm">
            <p><strong>ID do Caso:</strong> ${caso.id}</p>
            <p><strong>Nº Inquérito:</strong> ${escapeHTML(caso.inquerito_policial) || 'N/A'}</p>
            <p><strong>Nº Autos:</strong> ${escapeHTML(caso.autos) || 'N/A'}</p>
            <div class="pt-2"><strong>Relato dos Fatos:</strong><p class="whitespace-pre-wrap font-mono p-2 bg-gray-50 rounded">${escapeHTML(caso.relato_fatos) || 'N/A'}</p></div>
            <div class="pt-2"><strong>Das Investigações:</strong><p class="whitespace-pre-wrap font-mono p-2 bg-gray-50 rounded">${escapeHTML(caso.investigacoes) || 'N/A'}</p></div>
            <div class="pt-2"><strong>Conclusão:</strong><p class="whitespace-pre-wrap font-mono p-2 bg-gray-50 rounded">${escapeHTML(caso.conclusao) || 'N/A'}</p></div>
        </div>`;
        
        const sections = {
            'Pessoas': data.pessoas.map(p => `<li><strong>${escapeHTML(p.nome_completo)}</strong> (Atuação: ${escapeHTML(p.atuacao)})</li>`),
            'Ocorrências': data.ocorrencias.map(o => `<li>BO ${escapeHTML(o.numero_bo)}</li>`),
            'Veículos': data.veiculos.map(v => `<li>Placa ${escapeHTML(v.placa)} (${escapeHTML(v.marca_modelo)})</li>`),
            'Objetos': data.objetos.map(o => `<li>${escapeHTML(o.tipo)} - ${escapeHTML(o.marca) || ''}</li>`),
            'Telefones': data.telefones.map(t => `<li>${escapeHTML(t.numero)}</li>`)
        };

        for (const [title, items] of Object.entries(sections)) {
            html += `<hr class="my-3"><h4 class="font-semibold mt-2 mb-1">${title}:</h4>`;
            if (items.length > 0) {
                html += '<ul class="list-disc pl-5 text-sm space-y-1">' + items.join('') + '</ul>';
            } else {
                html += '<p class="text-sm text-gray-500">Nenhum.</p>';
            }
        }
        content.innerHTML = html;
    }
}
        function abrirModalExclusaoCaso(id, inquerito) { document.getElementById('delete-case-message').textContent = `Deseja excluir o caso do Inquérito Nº ${inquerito}?`; confirmDeleteCaseBtn.dataset.id = id; toggleModal('delete-case-modal', true); }
        async function excluirCaso() {
            const id = confirmDeleteCaseBtn.dataset.id;
            try {
                const response = await fetch(`${API_URL}?action=deleteCaso`, { method: 'POST', body: JSON.stringify({ id: id }), headers: { 'Content-Type': 'application/json' } });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch (e) { }
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) {
                    toggleModal('delete-case-modal', false);
                    carregarCasos();
                    alert('Caso excluído com sucesso!');
                } else {
                    alert('Erro ao excluir caso: ' + (result.message || 'Erro desconhecido.'));
                }
            } catch (error) {
                console.error("Erro ao excluir caso:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        }

        // Função escapeHTML (assumindo que pode não estar globalmente disponível em todos os contextos)
        // Se já estiver global, esta pode ser removida.
        function escapeHTML(str) {
            if (str === null || typeof str === 'undefined') {
                return '';
            }
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(String(str)));
            return div.innerHTML;
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
                // ADICIONE ESTAS DUAS LINHAS:
                document.getElementById('edit_investigacoes').value = caso.investigacoes || '';
                document.getElementById('edit_conclusao').value = caso.conclusao || '';

                linkedItemsManager.loadForEdit(data);
                toggleModal('edit-case-modal', true);
            }
        }
        async function salvarAdicaoCaso(e) {
            e.preventDefault();
            const basePayload = Object.fromEntries(new FormData(e.target).entries());
            const linkedData = linkedItemsManager.getPayloadData('add');
            const payload = { ...basePayload, ...linkedData };

            try {
                const response = await fetch(`${API_URL}?action=addCaso`, { method: 'POST', body: JSON.stringify(payload), headers: { 'Content-Type': 'application/json' } });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch (e) { }
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) {
                    e.target.reset();
                    linkedItemsManager.reset('add');
                    carregarCasos();
                    alert('Caso adicionado com sucesso!');
                } else {
                    alert('Erro ao adicionar caso: ' + (result.message || 'Erro desconhecido.'));
                }
            } catch (error) {
                console.error("Erro ao adicionar caso:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        }
        async function salvarEdicaoCaso(e) {
            e.preventDefault();
            const basePayload = Object.fromEntries(new FormData(e.target).entries());
            const linkedData = linkedItemsManager.getPayloadData('edit');
            const payload = { ...basePayload, ...linkedData };

            try {
                const response = await fetch(`${API_URL}?action=updateCaso`, { method: 'POST', body: JSON.stringify(payload), headers: { 'Content-Type': 'application/json' } });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch (e) { }
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) {
                    toggleModal('edit-case-modal', false);
                    carregarCasos();
                    alert('Caso atualizado com sucesso!');
                } else {
                    alert('Erro ao atualizar caso: ' + (result.message || 'Erro desconhecido.'));
                }
            } catch (error) {
                console.error("Erro ao atualizar caso:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const searchTypes = ['pessoa', 'ocorrencia', 'veiculo', 'objeto', 'telefone'];
            const configs = { add: { prefix: '' }, edit: { prefix: 'edit-' } };
            const actions = { pessoa: 'searchPessoas', ocorrencia: 'searchOcorrencias', veiculo: 'searchVeiculos', objeto: 'searchObjetos', telefone: 'searchTelefones' };
            const labels = { pessoa: item => item.nome_completo, ocorrencia: item => `BO: ${item.numero_bo}`, veiculo: item => `Placa: ${item.placa}`, objeto: item => item.tipo, telefone: item => item.numero };
            for (const mode in configs) {
                const prefix = configs[mode].prefix;
                for (const type of searchTypes) {
                    const currentMode = mode; // Capture mode for the closure
                    setupGenericSearch(`${prefix}search-${type}`, `${prefix}search-results-${type}`, actions[type],
                        (item) => linkedItemsManager.addItem(currentMode, type, item),
                        labels[type]);
                }
            }
            carregarCasos();
            confirmDeleteCaseBtn.addEventListener('click', excluirCaso);
            formAddCaso.addEventListener('submit', salvarAdicaoCaso);
            formEditCaso.addEventListener('submit', salvarEdicaoCaso);
        });
    </script>
</body>

</html>