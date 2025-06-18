<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Cadastro de Locais</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .modal { display: none; }
        .modal.flex { display: flex; }
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
                        Vínculos</a>
                    <a href="busca_avancada.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Busca Avançada</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Locais</h1>
            <p class="text-gray-500 mt-1">Cadastre, edite e gerencie locais de interesse para as investigações.</p>
        </header>
        
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Adicionar Novo Local</h2>
            <form id="form-add-local">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-3"><label for="descricao" class="block text-sm font-medium">Descrição do Local</label><input type="text" id="descricao" name="descricao" placeholder="Ex: Sede da ORCRIM, Cativeiro, Ponto de Venda" class="mt-1 w-full p-2 border rounded" required></div>
                    <div><label for="cep" class="block text-sm font-medium">CEP</label><input type="text" id="cep" name="cep" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="rua" class="block text-sm font-medium">Rua</label><input type="text" id="rua" name="rua" class="mt-1 w-full p-2 border rounded bg-gray-50"></div>
                     <div><label for="numero" class="block text-sm font-medium">Número</label><input type="text" id="numero" name="numero" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="bairro" class="block text-sm font-medium">Bairro</label><input type="text" id="bairro" name="bairro" class="mt-1 w-full p-2 border rounded bg-gray-50"></div>
                    <div><label for="municipio" class="block text-sm font-medium">Município</label><input type="text" id="municipio" name="municipio" class="mt-1 w-full p-2 border rounded bg-gray-50"></div>
                    <div><label for="uf" class="block text-sm font-medium">UF</label><input type="text" id="uf" name="uf" class="mt-1 w-full p-2 border rounded bg-gray-50"></div>
                     <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label for="latitude" class="block text-sm font-medium">Latitude</label><input type="text" id="latitude" name="latitude" placeholder="Ex: -23.550520" class="mt-1 w-full p-2 border rounded"></div>
                        <div><label for="longitude" class="block text-sm font-medium">Longitude</label><input type="text" id="longitude" name="longitude" placeholder="Ex: -46.633308" class="mt-1 w-full p-2 border rounded"></div>
                    </div>
                </div>
                <div class="mt-8 text-right"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar Local</button></div>
            </form>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
             <h2 class="text-2xl font-semibold mb-6">Locais Cadastrados</h2>
             <div class="overflow-x-auto">
                <table class="min-w-full bg-white"><thead class="bg-gray-200"><tr><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Descrição</th><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Endereço</th><th class="py-3 px-4 text-center uppercase text-xs font-semibold">Ações</th></tr></thead><tbody id="lista-locais"></tbody></table>
             </div>
        </div>
    </div>

    <div id="edit-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-3xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6 max-h-[90vh] overflow-y-auto"><div class="flex justify-between items-center pb-3 border-b"><p class="text-2xl font-bold">Editar Local</p><div class="cursor-pointer z-50" onclick="toggleModal('edit-modal', false)"><span class="text-3xl">&times;</span></div></div>
            <form id="form-edit-local" class="py-4">
                <input type="hidden" id="edit_local_id" name="id">
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-3"><label for="edit_descricao" class="block text-sm font-medium">Descrição do Local</label><input type="text" id="edit_descricao" name="descricao" class="mt-1 w-full p-2 border rounded" required></div>
                    <div><label for="edit_cep" class="block text-sm font-medium">CEP</label><input type="text" id="edit_cep" name="cep" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_rua" class="block text-sm font-medium">Rua</label><input type="text" id="edit_rua" name="rua" class="mt-1 w-full p-2 border rounded"></div>
                     <div><label for="edit_numero" class="block text-sm font-medium">Número</label><input type="text" id="edit_numero" name="numero" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_bairro" class="block text-sm font-medium">Bairro</label><input type="text" id="edit_bairro" name="bairro" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_municipio" class="block text-sm font-medium">Município</label><input type="text" id="edit_municipio" name="municipio" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_uf" class="block text-sm font-medium">UF</label><input type="text" id="edit_uf" name="uf" class="mt-1 w-full p-2 border rounded"></div>
                     <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label for="edit_latitude" class="block text-sm font-medium">Latitude</label><input type="text" id="edit_latitude" name="latitude" class="mt-1 w-full p-2 border rounded"></div>
                        <div><label for="edit_longitude" class="block text-sm font-medium">Longitude</label><input type="text" id="edit_longitude" name="longitude" class="mt-1 w-full p-2 border rounded"></div>
                    </div>
                </div>
                <div class="flex justify-end pt-4 mt-4 border-t"><button type="button" class="px-4 bg-gray-200 p-3 rounded-lg mr-2" onclick="toggleModal('edit-modal', false)">Cancelar</button><button type="submit" class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Alterações</button></div>
            </form>
        </div></div>
    </div>
    
    <div id="details-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6">
                <div class="flex justify-between items-center pb-3 border-b"><p class="text-2xl font-bold">Detalhes do Local</p><div class="cursor-pointer z-50" onclick="toggleModal('details-modal', false)"><span class="text-3xl">&times;</span></div></div>
                <div id="details-content" class="my-4 p-2"></div>
                <div class="flex justify-end pt-2 border-t"><button class="px-4 bg-gray-500 p-2 rounded-lg text-white hover:bg-gray-600" onclick="toggleModal('details-modal', false)">Fechar</button></div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = 'api.php';
        const addForm = document.getElementById('form-add-local');
        const editForm = document.getElementById('form-edit-local');
        const listaLocais = document.getElementById('lista-locais');

        function toggleModal(modalId, show) {
            const modal = document.getElementById(modalId);
            if (show) modal.classList.add('flex');
            else modal.classList.remove('flex');
        }

        async function carregarLocais() {
            try {
                const response = await fetch(`${API_URL}?action=getLocais`);
                const locais = await response.json();
                listaLocais.innerHTML = '';
                if (locais.length > 0) {
                    locais.forEach(l => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-b hover:bg-gray-50';
                        const endereco = `${escapeHTML(l.rua) || ''}, ${escapeHTML(l.municipio) || ''} - ${escapeHTML(l.uf) || ''}`;
                        tr.innerHTML = `
                            <td class="py-3 px-4">${escapeHTML(l.descricao) || 'N/A'}</td>
                            <td class="py-3 px-4">${escapeHTML(endereco)}</td>
                            <td class="py-3 px-4 text-center">
                                <button onclick="abrirModalDetalhes(${l.id})" class="bg-blue-500 text-white font-bold py-1 px-2 text-xs rounded">Detalhes</button>
                                <button onclick="abrirModalEdicao(${l.id})" class="bg-yellow-500 text-white font-bold py-1 px-2 text-xs rounded ml-2">Editar</button>
                                <button onclick="excluirLocal(${l.id})" class="bg-red-600 text-white font-bold py-1 px-2 text-xs rounded ml-2">Excluir</button>
                            </td>
                        `;
                        listaLocais.appendChild(tr);
                    });
                } else {
                    listaLocais.innerHTML = '<tr><td colspan="3" class="text-center p-8">Nenhum local cadastrado.</td></tr>';
                }
            } catch (error) { console.error("Erro ao carregar locais:", error); }
        }

        addForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(addForm);
            const data = Object.fromEntries(formData.entries());
            try {
                const response = await fetch(`${API_URL}?action=addLocal`, { method: 'POST', body: JSON.stringify(data), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) {
                    addForm.reset();
                    carregarLocais();
                    alert('Local adicionado com sucesso!');
                } else {
                    alert('Erro ao adicionar local: ' + (result.message || 'Erro desconhecido.'));
                }
            } catch (error) {
                console.error("Erro ao adicionar local:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        });

        async function abrirModalEdicao(id) {
            const response = await fetch(`${API_URL}?action=getLocalById&id=${id}`);
            const l = await response.json();
            if(l){
                document.getElementById('edit_local_id').value = l.id;
                document.getElementById('edit_descricao').value = l.descricao;
                document.getElementById('edit_cep').value = l.cep;
                document.getElementById('edit_rua').value = l.rua;
                document.getElementById('edit_numero').value = l.numero;
                document.getElementById('edit_bairro').value = l.bairro;
                document.getElementById('edit_municipio').value = l.municipio;
                document.getElementById('edit_uf').value = l.uf;
                document.getElementById('edit_latitude').value = l.latitude;
                document.getElementById('edit_longitude').value = l.longitude;
                toggleModal('edit-modal', true);
            }
        }
        
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(editForm);
            const data = Object.fromEntries(formData.entries());
            try {
                const response = await fetch(`${API_URL}?action=updateLocal`, { method: 'POST', body: JSON.stringify(data), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if(result.success) {
                    toggleModal('edit-modal', false);
                    carregarLocais();
                    alert('Local atualizado com sucesso!');
                } else {
                    alert('Erro ao atualizar local: ' + (result.message || 'Erro desconhecido.'));
                }
            } catch (error) {
                console.error("Erro ao atualizar local:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        });

        async function excluirLocal(id) {
            if (!confirm('Tem certeza que deseja excluir este local? A ação não pode ser desfeita.')) return;
            try {
                const response = await fetch(`${API_URL}?action=deleteLocal`, { method: 'POST', body: JSON.stringify({ id: id }), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) {
                    carregarLocais();
                    alert('Local excluído com sucesso!');
                } else {
                    alert('Erro ao excluir local: ' + (result.message || 'Verifique se o local não está associado a uma ocorrência.'));
                }
            } catch (error) {
                console.error("Erro ao excluir local:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        }
        
        async function abrirModalDetalhes(id) {
            const response = await fetch(`${API_URL}?action=getLocalById&id=${id}`);
            const l = await response.json();
            const detailsContent = document.getElementById('details-content');
            if (l) {
                detailsContent.innerHTML = `
                    <div class="space-y-3 text-sm text-gray-700">
                        <div><strong class="block text-gray-500">Descrição:</strong><p>${escapeHTML(l.descricao) || 'N/A'}</p></div>
                        <hr>
                        <div><strong class="block text-gray-500">Endereço:</strong><p>${escapeHTML(l.rua) || ''}, ${escapeHTML(l.numero) || 'S/N'} - ${escapeHTML(l.bairro) || ''}, ${escapeHTML(l.municipio) || ''} - ${escapeHTML(l.uf) || ''}</p></div>
                        <div><strong class="block text-gray-500">CEP:</strong><p>${escapeHTML(l.cep) || 'N/A'}</p></div>
                        <hr>
                        <div><strong class="block text-gray-500">Coordenadas:</strong><p>Lat: ${escapeHTML(l.latitude) || 'N/A'}, Lon: ${escapeHTML(l.longitude) || 'N/A'}</p></div>
                    </div>
                `;
                toggleModal('details-modal', true);
            } else {
                alert('Não foi possível carregar os detalhes do local.');
            }
        }
        
        // Função escapeHTML (assumindo que pode não estar globalmente disponível em todos os contextos)
        // Se já estiver global, esta pode ser removida.
        function escapeHTML(str) {
            if (str === null || typeof str === 'undefined') return '';
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(String(str)));
            return div.innerHTML;
        }
        
        // Função para buscar endereço ao digitar o CEP
        document.getElementById('cep').addEventListener('blur', async function() {
            const cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (cep.length === 8) {
                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                if(response.ok) {
                    const data = await response.json();
                    if (!data.erro) {
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('municipio').value = data.localidade;
                        document.getElementById('uf').value = data.uf;
                        document.getElementById('numero').focus(); // Move o foco para o campo de número
                    }
                }
            }
        });

        document.addEventListener('DOMContentLoaded', carregarLocais);
    </script>

</body>
</html>