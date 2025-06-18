<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Busca Avançada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Estilos adicionais para a busca avançada podem ser adicionados aqui */
        .loader {
            border-top-color: #3498db; /* Azul SAVIP */
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }
        @-webkit-keyframes spinner {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold">SAVIP</div>
                <div>
                    <a href="casos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Casos</a>
                    <a href="index.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Pessoas</a>
                    <a href="ocorrencias.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Ocorrências</a>
                    <a href="locais.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Locais</a>
                    <a href="veiculos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Veículos</a>
                    <a href="objetos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Objetos</a>
                    <a href="telefones.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Telefones</a>
                    <a href="analise.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Análise de Vínculos</a>
                    <a href="busca_avancada.php" class="px-3 py-2 rounded-md text-sm font-medium bg-gray-900">Busca Avançada</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Busca Avançada</h1>
            <p class="text-gray-500 mt-1">Construa consultas complexas cruzando informações de diferentes entidades.</p>
        </header>

        <!-- Seção de Filtros da Busca -->
        <div id="search-filters-section" class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Critérios da Busca Avançada</h2>

            <div id="entity-selection" class="mb-6 pb-6 border-b">
                <h3 class="text-lg font-semibold mb-3 text-gray-700">1. Selecione as Entidades para Buscar:</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div><label class="flex items-center space-x-2"><input type="checkbox" name="entity_type" value="pessoa" class="form-checkbox h-5 w-5 text-blue-600"><span>Pessoas</span></label></div>
                    <div><label class="flex items-center space-x-2"><input type="checkbox" name="entity_type" value="veiculo" class="form-checkbox h-5 w-5 text-blue-600"><span>Veículos</span></label></div>
                    <div><label class="flex items-center space-x-2"><input type="checkbox" name="entity_type" value="ocorrencia" class="form-checkbox h-5 w-5 text-blue-600"><span>Ocorrências</span></label></div>
                    <div><label class="flex items-center space-x-2"><input type="checkbox" name="entity_type" value="objeto" class="form-checkbox h-5 w-5 text-blue-600"><span>Objetos</span></label></div>
                    <div><label class="flex items-center space-x-2"><input type="checkbox" name="entity_type" value="telefone" class="form-checkbox h-5 w-5 text-blue-600"><span>Telefones</span></label></div>
                    <div><label class="flex items-center space-x-2"><input type="checkbox" name="entity_type" value="caso" class="form-checkbox h-5 w-5 text-blue-600"><span>Casos</span></label></div>
                    <div><label class="flex items-center space-x-2"><input type="checkbox" name="entity_type" value="local" class="form-checkbox h-5 w-5 text-blue-600"><span>Locais</span></label></div>
                </div>
            </div>

            <div id="filter-groups-container" class="space-y-8 mb-6">
                <!-- Grupos de filtros por entidade serão adicionados aqui por JavaScript -->
                <p id="no-entity-selected-message" class="text-gray-500">Selecione uma ou mais entidades acima para adicionar filtros.</p>
            </div>

            <div class="flex items-center justify-between mt-8 pt-6 border-t">
                <div>
                    <label for="logical-operator" class="block text-sm font-medium text-gray-700 mb-1">Operador Lógico entre Grupos de Filtro de Entidades Diferentes:</label>
                    <select id="logical-operator" name="logical_operator" class="p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="AND" selected>E (todos os grupos de entidades devem corresponder)</option>
                        <option value="OR">OU (qualquer um dos grupos de entidades pode corresponder)</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Define como os resultados de diferentes tipos de entidade são combinados.</p>
                </div>
                <button id="btn-advanced-search" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                    Buscar
                </button>
            </div>
        </div>

        <!-- Seção de Resultados da Busca -->
        <div id="search-results-section" class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-6">Resultados</h2>
            <p class="text-gray-600">Os resultados da busca aparecerão aqui...</p>
            <!-- Conteúdo dos resultados virá aqui -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Página de Busca Avançada carregada.');
            const API_URL = 'api.php'; // Definindo API_URL para uso nas funções

            const entityCheckboxes = document.querySelectorAll('input[name="entity_type"]');
            const filterGroupsContainer = document.getElementById('filter-groups-container');
            const noEntitySelectedMessage = document.getElementById('no-entity-selected-message');

            const entityFields = {
                pessoa: [
                    { value: 'nome_completo', text: 'Nome Completo' }, { value: 'cpf', text: 'CPF' },
                    { value: 'alcunha', text: 'Alcunha' }, { value: 'rg', text: 'RG' },
                    { value: 'nome_mae', text: 'Nome da Mãe' }, { value: 'data_nascimento', text: 'Data Nascimento' },
                    { value: 'is_high_interest', text: 'Alto Interesse'}
                ],
                veiculo: [
                    { value: 'placa', text: 'Placa' }, { value: 'chassi', text: 'Chassi' },
                    { value: 'marca_modelo', text: 'Marca/Modelo' }, { value: 'cor', text: 'Cor' },
                    { value: 'ano_modelo', text: 'Ano/Modelo'}, { value: 'is_high_interest', text: 'Alto Interesse'}
                ],
                ocorrencia: [
                    { value: 'numero_bo', text: 'Número BO' }, { value: 'fatos_comunicados', text: 'Relato dos Fatos' },
                    { value: 'data_fato', text: 'Data do Fato' }, { value: 'local_id', text: 'ID Local Vinculado'}
                ],
                objeto: [
                    { value: 'tipo', text: 'Tipo' }, { value: 'marca', text: 'Marca' },
                    { value: 'modelo', text: 'Modelo'}, { value: 'numero_serie', text: 'Número de Série' },
                    { value: 'is_high_interest', text: 'Alto Interesse'}
                ],
                telefone: [
                    { value: 'numero', text: 'Número' }, { value: 'imei', text: 'IMEI' },
                    { value: 'operadora', text: 'Operadora'}, { value: 'is_high_interest', text: 'Alto Interesse'}
                ],
                caso: [
                    { value: 'inquerito_policial', text: 'Nº Inquérito' }, { value: 'autos', text: 'Nº Autos' },
                    { value: 'relato_fatos', text: 'Relato Fatos (Caso)'}, { value: 'investigacoes', text: 'Investigações (Caso)'},
                    { value: 'conclusao', text: 'Conclusão (Caso)'}
                ],
                local: [
                    { value: 'descricao', text: 'Descrição Local' }, { value: 'rua', text: 'Rua' },
                    { value: 'bairro', text: 'Bairro' }, { value: 'municipio', text: 'Município' }, { value: 'cep', text: 'CEP'}
                ]
            };

            const comparisonOperators = [
                { value: '=', text: 'Igual a' }, { value: 'LIKE', text: 'Contém' },
                { value: 'NOT LIKE', text: 'Não Contém' }, { value: 'STARTS_WITH', text: 'Inicia com' },
                { value: 'ENDS_WITH', text: 'Termina com' }, { value: '>', text: 'Maior que' },
                { value: '<', text: 'Menor que' }, { value: '>=', text: 'Maior ou Igual a' },
                { value: '<=', text: 'Menor ou Igual a' }, { value: '!=', text: 'Diferente de' }
            ];

            function createFilterGroup(entityValue, entityName) {
                const groupId = `filter-group-${entityValue}-${Date.now()}`;
                const groupDiv = document.createElement('div');
                groupDiv.id = groupId;
                groupDiv.className = 'p-6 border border-gray-300 rounded-lg shadow-sm bg-white space-y-4';
                groupDiv.innerHTML = `
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-indigo-700">${entityName}</h3>
                        <button type="button" title="Remover este grupo de filtros" class="remove-filter-group-btn text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </div>
                    <div class="filter-criteria-list space-y-3"></div>
                    <div class="flex items-center justify-between pt-3 border-t mt-4">
                        <button type="button" class="add-criterion-btn bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                            Adicionar Critério para ${entityName}
                        </button>
                        <div class="flex items-center">
                            <label class="text-sm font-medium text-gray-700 mr-2">Operador entre critérios de ${entityName}:</label>
                            <select name="group_operator_${entityValue}" class="p-1.5 border rounded-md text-sm">
                                <option value="AND" selected>E (todos os critérios devem corresponder)</option>
                                <option value="OR">OU (qualquer critério pode corresponder)</option>
                            </select>
                        </div>
                    </div>`;
                filterGroupsContainer.appendChild(groupDiv);
                addCriterion(groupDiv.querySelector('.filter-criteria-list'), entityValue);
                groupDiv.querySelector('.remove-filter-group-btn').addEventListener('click', () => {
                    groupDiv.remove();
                    document.querySelector(`input[name="entity_type"][value="${entityValue}"]`).checked = false;
                    updateNoEntityMessage();
                });
                groupDiv.querySelector('.add-criterion-btn').addEventListener('click', () => {
                    addCriterion(groupDiv.querySelector('.filter-criteria-list'), entityValue);
                });
            }

            function addCriterion(criteriaListDiv, entityValue) {
                const criterionId = `criterion-${entityValue}-${Date.now()}`;
                const criterionDiv = document.createElement('div');
                criterionDiv.id = criterionId;
                criterionDiv.className = 'criterion-item flex items-center space-x-2 p-3 bg-gray-50 rounded-md border';
                let fieldOptions = (entityFields[entityValue] || []).map(field => `<option value="${field.value}">${field.text}</option>`).join('');
                let operatorOptions = comparisonOperators.map(op => `<option value="${op.value}">${op.text}</option>`).join('');
                criterionDiv.innerHTML = `
                    <select name="field_${entityValue}" class="field-select p-2 border rounded-md shadow-sm w-1/3 text-sm">${fieldOptions}</select>
                    <select name="operator_${entityValue}" class="operator-select p-2 border rounded-md shadow-sm w-1/4 text-sm">${operatorOptions}</select>
                    <input type="text" name="value_${entityValue}" placeholder="Valor" class="value-input p-2 border rounded-md shadow-sm flex-grow text-sm">
                    <button type="button" title="Remover este critério" class="remove-criterion-btn text-red-500 hover:text-red-600 p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </button>`;
                criteriaListDiv.appendChild(criterionDiv);
                criterionDiv.querySelector('.remove-criterion-btn').addEventListener('click', () => {
                    if (criteriaListDiv.children.length > 1) criterionDiv.remove();
                    else alert("Cada grupo de filtro de entidade deve ter pelo menos um critério.");
                });
                const fieldSelect = criterionDiv.querySelector('.field-select');
                const valueInput = criterionDiv.querySelector('.value-input');
                const updateInputType = () => {
                    const selectedField = entityFields[entityValue]?.find(f => f.value === fieldSelect.value);
                    if (selectedField && (selectedField.value.includes('data_') || selectedField.text.toLowerCase().includes('data'))) {
                        valueInput.type = 'date'; valueInput.placeholder = 'YYYY-MM-DD';
                    } else if (selectedField && selectedField.value === 'is_high_interest') {
                        valueInput.type = 'checkbox'; valueInput.placeholder = ''; valueInput.value = '1'; // Default to checked for boolean
                        // Consider adding a label or changing how boolean/checkbox is handled for clarity
                    }
                    else {
                        valueInput.type = 'text'; valueInput.placeholder = 'Valor';
                    }
                };
                fieldSelect.addEventListener('change', updateInputType);
                updateInputType(); // Initial call
            }

            function updateNoEntityMessage() {
                const activeGroups = filterGroupsContainer.querySelectorAll('div[id^="filter-group-"]');
                if (activeGroups.length === 0) {
                    noEntitySelectedMessage.style.display = 'block';
                } else {
                    noEntitySelectedMessage.style.display = 'none';
                }
            }
            
            updateNoEntityMessage();

            entityCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', (e) => {
                    const entityValue = e.target.value;
                    const entityName = e.target.nextElementSibling.textContent;
                    const existingGroup = document.querySelector(`#filter-groups-container > div[id^="filter-group-${entityValue}"]`);
                    if (e.target.checked && !existingGroup) createFilterGroup(entityValue, entityName);
                    else if (!e.target.checked && existingGroup) existingGroup.remove();
                    updateNoEntityMessage();
                });
            });

            const searchButton = document.getElementById('btn-advanced-search');
            searchButton.addEventListener('click', collectAndSearchData);

            async function collectAndSearchData() {
                const selectedEntities = Array.from(document.querySelectorAll('input[name="entity_type"]:checked')).map(cb => cb.value);
                if (selectedEntities.length === 0) {
                    alert("Por favor, selecione pelo menos uma entidade para buscar.");
                    return;
                }
                const queryPayload = {
                    global_operator: document.getElementById('logical-operator').value,
                    entity_filters: []
                };
                selectedEntities.forEach(entityValue => {
                    const groupDiv = document.querySelector(`#filter-groups-container > div[id^="filter-group-${entityValue}"]`);
                    if (!groupDiv) return;
                    const entityFilterGroup = {
                        entity_type: entityValue,
                        group_operator: groupDiv.querySelector(`select[name="group_operator_${entityValue}"]`).value,
                        criteria: []
                    };
                    const criteriaItems = groupDiv.querySelectorAll('.criterion-item');
                    criteriaItems.forEach(item => {
                        const field = item.querySelector('.field-select').value;
                        const operator = item.querySelector('.operator-select').value;
                        const valueInput = item.querySelector('.value-input');
                        let value = valueInput.value.trim();
                        if (valueInput.type === 'checkbox') {
                            value = valueInput.checked ? '1' : '0';
                        }
                        if (value !== "" || valueInput.type === 'checkbox') { // Checkbox value '0' is valid
                            entityFilterGroup.criteria.push({ field, operator, value });
                        }
                    });
                    if (entityFilterGroup.criteria.length > 0) {
                        queryPayload.entity_filters.push(entityFilterGroup);
                    }
                });
                if (queryPayload.entity_filters.length === 0) {
                    alert("Por favor, adicione pelo menos um critério de busca com valor preenchido para as entidades selecionadas.");
                    return;
                }

                const resultsSection = document.getElementById('search-results-section');
                resultsSection.innerHTML = `<h2 class="text-2xl font-semibold mb-6">Resultados</h2><div class="text-center p-5"><div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4 mx-auto"></div><p class="text-gray-600">Buscando... Aguarde.</p></div>`;
                
                try {
                    const response = await fetch(API_URL, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ ...queryPayload, action: 'advancedSearch' })
                    });
                    if (!response.ok) {
                        const errorData = await response.json().catch(() => null);
                        throw new Error(`Erro na API: ${response.status} ${response.statusText}. ` + (errorData ? errorData.message : ''));
                    }
                    const data = await response.json();
                    if (data.success && data.results) {
                        renderResults(data.results);
                    } else {
                        resultsSection.innerHTML = `<h2 class="text-2xl font-semibold mb-6">Resultados</h2><p class="text-red-500">Erro ao buscar: ${data.message || 'Nenhum resultado encontrado ou erro na API.'}</p>`;
                        if (data.debug_input) console.log("Debug Input Recebido pela API:", data.debug_input);
                    }
                } catch (error) {
                    console.error('Erro ao realizar busca avançada:', error);
                    resultsSection.innerHTML = `<h2 class="text-2xl font-semibold mb-6">Resultados</h2><p class="text-red-500">Falha na comunicação com a API: ${error.message}</p>`;
                }
            }

            function renderResults(results) {
                const resultsSection = document.getElementById('search-results-section');
                let html = `<h2 class="text-2xl font-semibold mb-6">Resultados (${results.length})</h2>`;
                if (results.length === 0) {
                    html += '<p class="text-gray-600">Nenhum resultado encontrado para os critérios informados.</p>';
                } else {
                    html += '<ul class="space-y-4">';
                    results.forEach(item => {
                        let detailsLink = item.details_link || '#';
                        html += `
                            <li class="p-4 border rounded-md shadow-sm bg-gray-50 hover:bg-gray-100 transition-colors">
                                <h4 class="text-lg font-medium text-blue-700">${item.entity_type_label || item.entity_type.charAt(0).toUpperCase() + item.entity_type.slice(1)}</h4>
                                <p class="text-gray-800">${item.display_label || 'Detalhes não disponíveis'}</p>
                                ${item.is_high_interest == '1' ? '<p class="text-sm font-semibold text-red-600 mt-1">ALTO INTERESSE</p>' : ''}
                                <a href="${detailsLink}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline mt-1 inline-block">
                                    Ver Detalhes &rarr;
                                </a>
                            </li>`;
                    });
                    html += '</ul>';
                }
                resultsSection.innerHTML = html;
            }
        });
    </script>
</body>
</html>
