<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Cadastro de Telefones</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .modal { display: none; }
        .modal.flex { display: flex; }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Menu de Navegação -->
    <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="text-xl font-bold">SAVIP</div>
                <div><a href="casos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Casos</a><a
                        href="index.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Pessoas</a>
                        <a href="ocorrencias.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Ocorrências</a>
                        <a href="locais.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Locais</a>
                        <a href="veiculos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Veículos</a><a
                        href="objetos.php"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Objetos</a><a
                        href="telefones.php"
                        class="px-3 py-2 rounded-md text-sm font-medium bg-gray-900">Telefones</a><a
                        href="analise.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Análise de
                        Vínculos</a>
                    <a href="busca_avancada.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Busca Avançada</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Telefones</h1>
            <p class="text-gray-500 mt-1">Cadastre e gerencie telefones de interesse.</p>
        </header>
        
        <!-- Formulário de Cadastro -->
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Adicionar Novo Telefone</h2>
            <form id="form-add-telefone">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div><label for="numero" class="block text-sm font-medium">Número</label><input type="text" id="numero" name="numero" placeholder="(XX) 9XXXX-XXXX" class="mt-1 w-full p-2 border rounded" required></div>
                    <div><label for="imei" class="block text-sm font-medium">IMEI</label><input type="text" id="imei" name="imei" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="operadora" class="block text-sm font-medium">Operadora</label><input type="text" id="operadora" name="operadora" class="mt-1 w-full p-2 border rounded"></div>
                    <div class="md:col-span-3 mt-4">
                        <label for="is_high_interest" class="flex items-center">
                            <input type="checkbox" id="is_high_interest" name="is_high_interest" value="1" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">Marcar como Alto Interesse</span>
                        </label>
                    </div>
                </div>
                <div class="mt-8 text-right"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar Telefone</button></div>
            </form>
        </div>

        <!-- Lista de Telefones -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
             <h2 class="text-2xl font-semibold mb-6">Telefones Cadastrados</h2>
             <div class="overflow-x-auto">
                <table class="min-w-full bg-white"><thead class="bg-gray-200"><tr><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Número</th><th class="py-3 px-4 text-left uppercase text-xs font-semibold">IMEI</th><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Operadora</th><th class="py-3 px-4 text-center uppercase text-xs font-semibold">Ações</th></tr></thead><tbody id="lista-telefones"></tbody></table>
             </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div id="edit-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6"><div class="flex justify-between items-center pb-3 border-b"><p class="text-2xl font-bold">Editar Telefone</p><div class="cursor-pointer z-50" onclick="toggleModal('edit-modal', false)"><span class="text-3xl">&times;</span></div></div>
            <form id="form-edit-telefone" class="py-4">
                <input type="hidden" id="edit_telefone_id" name="id">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div><label for="edit_numero" class="block text-sm font-medium">Número</label><input type="text" id="edit_numero" name="numero" class="mt-1 w-full p-2 border rounded" required></div>
                    <div><label for="edit_imei" class="block text-sm font-medium">IMEI</label><input type="text" id="edit_imei" name="imei" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_operadora" class="block text-sm font-medium">Operadora</label><input type="text" id="edit_operadora" name="operadora" class="mt-1 w-full p-2 border rounded"></div>
                    <div class="md:col-span-3 mt-4">
                        <label for="edit_is_high_interest" class="flex items-center">
                            <input type="checkbox" id="edit_is_high_interest" name="is_high_interest" value="1" class="mr-2 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">Marcar como Alto Interesse</span>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end pt-4 mt-4 border-t"><button type="button" class="px-4 bg-gray-200 p-3 rounded-lg mr-2" onclick="toggleModal('edit-modal', false)">Cancelar</button><button type="submit" class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Alterações</button></div>
            </form>
        </div></div>
    </div>
    
    <script>
        const API_URL = 'api.php';
        const addForm = document.getElementById('form-add-telefone');
        const editForm = document.getElementById('form-edit-telefone');
        const listaTelefones = document.getElementById('lista-telefones');
        const editModal = document.getElementById('edit-modal');

        function toggleModal(modalId, show) { 
            const modal = document.getElementById(modalId); 
            if (modal) { // Adicionado para verificar se o modal existe
                if (show) modal.classList.add('flex'); else modal.classList.remove('flex'); 
            }
        }
        function toggleDetailsModal(show) { const modal = document.getElementById('details-modal'); if (show) modal.classList.add('flex'); else modal.classList.remove('flex'); }
        async function carregarTelefones() {
            try {
                const response = await fetch(`${API_URL}?action=getTelefones`);
                const telefones = await response.json();
                listaTelefones.innerHTML = '';
                if (telefones.length > 0) {
                    telefones.forEach(t => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-b hover:bg-gray-50';
                        tr.innerHTML = `
                            <td class="py-3 px-4">${escapeHTML(t.numero) || 'N/A'}</td>
                            <td class="py-3 px-4">${escapeHTML(t.imei) || 'N/A'}</td>
                            <td class="py-3 px-4">${escapeHTML(t.operadora) || 'N/A'}</td>
                            <td class="py-3 px-4 text-center">
                                <button onclick="abrirModalDetalhes(${t.id})" class="bg-blue-500 text-white font-bold py-1 px-2 text-xs rounded">Detalhes</button>
                                <button onclick="abrirModalEdicao(${t.id})" class="bg-yellow-500 text-white font-bold py-1 px-2 text-xs rounded ml-2">Editar</button>
                                <button onclick="excluirTelefone(${t.id})" class="bg-red-600 text-white font-bold py-1 px-2 text-xs rounded ml-2">Excluir</button>
                            </td>
                        `;
                        listaTelefones.appendChild(tr);
                    });
                } else {
                    listaTelefones.innerHTML = '<tr><td colspan="4" class="text-center p-8">Nenhum telefone cadastrado.</td></tr>';
                }
            } catch (error) { console.error("Erro ao carregar telefones:", error); }
        }

        addForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(addForm);
            const data = Object.fromEntries(formData.entries());
            data.is_high_interest = document.getElementById('is_high_interest').checked ? '1' : '0';
            try {
                const response = await fetch(`${API_URL}?action=addTelefone`, { method: 'POST', body: JSON.stringify(data), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) { 
                    addForm.reset();
                    document.getElementById('is_high_interest').checked = false; 
                    carregarTelefones(); 
                    alert('Telefone adicionado com sucesso!'); 
                } else { 
                    alert('Erro ao adicionar telefone: ' + (result.message || 'Erro desconhecido.')); 
                }
            } catch (error) {
                console.error("Erro ao adicionar telefone:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        });

        async function abrirModalEdicao(id) {
            const response = await fetch(`${API_URL}?action=getTelefoneById&id=${id}`);
            const t = await response.json();
            if(t){
                document.getElementById('edit_telefone_id').value = t.id;
                document.getElementById('edit_numero').value = t.numero;
                document.getElementById('edit_imei').value = t.imei;
                document.getElementById('edit_operadora').value = t.operadora;
                document.getElementById('edit_is_high_interest').checked = !!parseInt(t.is_high_interest);
                toggleModal('edit-modal', true); // Abre o modal de edição
            }
        }
        
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(editForm);
            const data = Object.fromEntries(formData.entries()); // Converte FormData para objeto para JSON
            data.is_high_interest = document.getElementById('edit_is_high_interest').checked ? '1' : '0';
            try {
                const response = await fetch(`${API_URL}?action=updateTelefone`, { method: 'POST', body: JSON.stringify(data), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if(result.success) { 
                    toggleModal('edit-modal', false);
                    carregarTelefones(); 
                    alert('Telefone atualizado com sucesso!');
                } else { 
                    alert('Erro ao atualizar telefone: ' + (result.message || 'Erro desconhecido.')); 
                }
            } catch (error) {
                console.error("Erro ao atualizar telefone:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        });

        async function excluirTelefone(id) {
            if (!confirm('Tem certeza que deseja excluir este telefone?')) return;
             try {
                const response = await fetch(`${API_URL}?action=deleteTelefone`, { method: 'POST', body: JSON.stringify({ id: id }), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) { carregarTelefones(); alert('Telefone excluído com sucesso!'); } 
                else { alert('Erro ao excluir telefone: ' + (result.message || 'Erro desconhecido.')); }
            } catch (error) {
                console.error("Erro ao excluir telefone:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        }

        document.addEventListener('DOMContentLoaded', carregarTelefones);

        async function abrirModalDetalhes(id) {
            const response = await fetch(`${API_URL}?action=getTelefoneById&id=${id}`);
            const t = await response.json();
            const detailsContent = document.getElementById('details-content');
            
            if (t) {
                detailsContent.innerHTML = `
                    <div class="space-y-3 text-sm text-gray-700">
                        <div><strong class="block text-gray-500">Número:</strong><p>${escapeHTML(t.numero) || 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">IMEI:</strong><p>${escapeHTML(t.imei) || 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Operadora:</strong><p>${escapeHTML(t.operadora) || 'N/A'}</p></div>
                    </div>
                `;
                // Os IDs detail_numero, detail_imei, detail_operadora não são mais necessários se o HTML é construído diretamente.
                document.getElementById('details-modal').classList.add('flex');
            } else {
                alert('Não foi possível carregar os detalhes do telefone.');
            }
        }
        // Função para fechar o modal de detalhes
        function fecharModalDetalhes() {
             toggleDetailsModal(false);
        }

        function escapeHTML(str) {
            if (str === null || typeof str === 'undefined') {
                return '';
            }
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(String(str)));
            return div.innerHTML;
        }
    </script>

    <div id="details-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Detalhes do Telefone</p>
                    <div class="cursor-pointer z-50" onclick="fecharModalDetalhes()">
                        <span class="text-3xl">&times;</span>
                    </div>
                </div>
                <div id="details-content" class="my-4 p-2">
                </div>
                <div class="flex justify-end pt-2 border-t">
                    <button class="px-4 bg-gray-500 p-2 rounded-lg text-white hover:bg-gray-600" onclick="document.getElementById('details-modal').classList.remove('flex')">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>