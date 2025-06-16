<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Cadastro de Veículos</title>
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
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Veículos</h1>
            <p class="text-gray-500 mt-1">Cadastre, edite e gerencie os veículos de interesse.</p>
        </header>
        
        <!-- Formulário de Cadastro -->
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Adicionar Novo Veículo</h2>
            <form id="form-add-veiculo">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div><label for="placa" class="block text-sm font-medium">Placa</label><input type="text" id="placa" name="placa" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="marca_modelo" class="block text-sm font-medium">Marca/Modelo</label><input type="text" id="marca_modelo" name="marca_modelo" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="ano_modelo" class="block text-sm font-medium">Ano/Modelo</label><input type="text" id="ano_modelo" name="ano_modelo" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="cor" class="block text-sm font-medium">Cor</label><input type="text" id="cor" name="cor" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="combustivel" class="block text-sm font-medium">Combustível</label><input type="text" id="combustivel" name="combustivel" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="renavam" class="block text-sm font-medium">Renavam</label><input type="text" id="renavam" name="renavam" class="mt-1 w-full p-2 border rounded"></div>
                    <div class="lg:col-span-2"><label for="chassi" class="block text-sm font-medium">Chassi</label><input type="text" id="chassi" name="chassi" class="mt-1 w-full p-2 border rounded"></div>
                </div>
                <div class="mt-8 text-right"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar Veículo</button></div>
            </form>
        </div>

        <!-- Lista de Veículos -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
             <h2 class="text-2xl font-semibold mb-6">Veículos Cadastrados</h2>
             <div class="overflow-x-auto">
                <table class="min-w-full bg-white"><thead class="bg-gray-200"><tr><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Placa</th><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Marca/Modelo</th><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Cor</th><th class="py-3 px-4 text-center uppercase text-xs font-semibold">Ações</th></tr></thead><tbody id="lista-veiculos"></tbody></table>
             </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div id="edit-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-3xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6"><div class="flex justify-between items-center pb-3 border-b"><p class="text-2xl font-bold">Editar Veículo</p><div class="cursor-pointer z-50" onclick="toggleModal('edit-modal', false)"><span class="text-3xl">&times;</span></div></div>
            <form id="form-edit-veiculo" class="py-4">
                <input type="hidden" id="edit_veiculo_id" name="id">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div><label for="edit_placa" class="block text-sm font-medium">Placa</label><input type="text" id="edit_placa" name="placa" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_marca_modelo" class="block text-sm font-medium">Marca/Modelo</label><input type="text" id="edit_marca_modelo" name="marca_modelo" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_ano_modelo" class="block text-sm font-medium">Ano/Modelo</label><input type="text" id="edit_ano_modelo" name="ano_modelo" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_cor" class="block text-sm font-medium">Cor</label><input type="text" id="edit_cor" name="cor" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_combustivel" class="block text-sm font-medium">Combustível</label><input type="text" id="edit_combustivel" name="combustivel" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_renavam" class="block text-sm font-medium">Renavam</label><input type="text" id="edit_renavam" name="renavam" class="mt-1 w-full p-2 border rounded"></div>
                    <div class="lg:col-span-2"><label for="edit_chassi" class="block text-sm font-medium">Chassi</label><input type="text" id="edit_chassi" name="chassi" class="mt-1 w-full p-2 border rounded"></div>
                </div>
                <div class="flex justify-end pt-4 mt-4 border-t"><button type="button" class="px-4 bg-gray-200 p-3 rounded-lg mr-2" onclick="toggleModal('edit-modal', false)">Cancelar</button><button type="submit" class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Alterações</button></div>
            </form>
        </div></div>
    </div>
    
    <script>
        const API_URL = 'api.php';
        const addForm = document.getElementById('form-add-veiculo');
        const editForm = document.getElementById('form-edit-veiculo');
        const listaVeiculos = document.getElementById('lista-veiculos');
        const editModal = document.getElementById('edit-modal');

        function toggleModal(modalId, show) { 
            const modal = document.getElementById(modalId); 
            if (modal) { // Adicionado para verificar se o modal existe
                if (show) modal.classList.add('flex'); else modal.classList.remove('flex'); 
            }
        }
        function toggleDetailsModal(show) { const modal = document.getElementById('details-modal'); if (show) modal.classList.add('flex'); else modal.classList.remove('flex'); }
        async function carregarVeiculos() {
            try {
                const response = await fetch(`${API_URL}?action=getVeiculos`);
                const veiculos = await response.json();
                listaVeiculos.innerHTML = '';
                if (veiculos.length > 0) {
                    veiculos.forEach(v => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-b hover:bg-gray-50';
                        tr.innerHTML = `
                            <td class="py-3 px-4">${escapeHTML(v.placa) || 'N/A'}</td>
                            <td class="py-3 px-4">${escapeHTML(v.marca_modelo) || 'N/A'}</td>
                            <td class="py-3 px-4">${escapeHTML(v.cor) || 'N/A'}</td>
                            <td class="py-3 px-4 text-center">
                                <button onclick="abrirModalDetalhes(${v.id})" class="bg-blue-500 text-white font-bold py-1 px-2 text-xs rounded">Detalhes</button>
                                <button onclick="abrirModalEdicao(${v.id})" class="bg-yellow-500 text-white font-bold py-1 px-2 text-xs rounded ml-2">Editar</button>
                                <button onclick="excluirVeiculo(${v.id})" class="bg-red-600 text-white font-bold py-1 px-2 text-xs rounded ml-2">Excluir</button>
                            </td>
                        `;
                        listaVeiculos.appendChild(tr);
                    });
                } else {
                    listaVeiculos.innerHTML = '<tr><td colspan="4" class="text-center p-8">Nenhum veículo cadastrado.</td></tr>';
                }
            } catch (error) { console.error("Erro ao carregar veículos:", error); }
        }

        addForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(addForm);
            const data = Object.fromEntries(formData.entries());
            try {
                const response = await fetch(`${API_URL}?action=addVeiculo`, { method: 'POST', body: JSON.stringify(data), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) { 
                    addForm.reset(); 
                    carregarVeiculos(); 
                    alert('Veículo adicionado com sucesso!'); 
                } else { 
                    alert('Erro ao adicionar veículo: ' + (result.message || 'Erro desconhecido.')); 
                }
            } catch (error) {
                console.error("Erro ao adicionar veículo:", error);
                alert("Falha na comunicação com o servidor: " + error.message);
            }
        });

        async function abrirModalEdicao(id) {
            const response = await fetch(`${API_URL}?action=getVeiculoById&id=${id}`);
            const v = await response.json();
            if(v){
                document.getElementById('edit_veiculo_id').value = v.id;
                document.getElementById('edit_placa').value = v.placa;
                document.getElementById('edit_marca_modelo').value = v.marca_modelo;
                document.getElementById('edit_ano_modelo').value = v.ano_modelo;
                document.getElementById('edit_cor').value = v.cor;
                document.getElementById('edit_combustivel').value = v.combustivel;
                document.getElementById('edit_renavam').value = v.renavam;
                document.getElementById('edit_chassi').value = v.chassi;
                toggleModal(true); // Abre o modal de edição
            } // CORRIGIDO: toggleModal('edit-modal', true)
        }
        
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(editForm);
            const data = Object.fromEntries(formData.entries());
             try { // CORRIGIDO: Adicionado try-catch
                const response = await fetch(`${API_URL}?action=updateVeiculo`, { method: 'POST', body: JSON.stringify(data), headers: {'Content-Type': 'application/json'} });
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`; // CORRIGIDO: Tratamento de erro HTTP
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if(result.success) { toggleModal(false); carregarVeiculos(); alert('Veículo atualizado com sucesso!'); } else { alert('Erro ao atualizar veículo: ' + (result.message || 'Erro desconhecido.')); }
            } catch (error) {
                 console.error("Erro ao processar resposta da API:", error);
                 alert("Falha na comunicação com o servidor: " + error.message); // CORRIGIDO: Mensagem de erro
            }
        });

        async function excluirVeiculo(id) {
            if (!confirm('Tem certeza que deseja excluir este veículo?')) return;
             try {
                const response = await fetch(`${API_URL}?action=deleteVeiculo`, { method: 'POST', body: JSON.stringify({ id: id }), headers: {'Content-Type': 'application/json'} }); // CORRIGIDO: Adicionado header
                if (!response.ok) {
                    let errorMsg = `HTTP error! status: ${response.status}`;
                    try { const errData = await response.json(); errorMsg = errData.message || errorMsg; } catch(e){}
                    throw new Error(errorMsg);
                }
                const result = await response.json();
                if (result.success) { carregarVeiculos(); alert('Veículo excluído com sucesso!'); } else { alert('Erro ao excluir veículo: ' + (result.message || 'Erro desconhecido.')); }
            } catch (error) { 
                console.error("Erro ao excluir veículo:", error); 
                alert("Falha na comunicação com o servidor: " + error.message); 
            }
        }

        document.addEventListener('DOMContentLoaded', carregarVeiculos);

        async function abrirModalDetalhes(id) {
            const response = await fetch(`${API_URL}?action=getVeiculoById&id=${id}`);
            const v = await response.json();
            const detailsContent = document.getElementById('details-content');

            if (v) {
                detailsContent.innerHTML = `
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                        <div><strong class="block text-gray-500">Placa:</strong><p>${v.placa ? escapeHTML(v.placa) : 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Marca/Modelo:</strong><p>${v.marca_modelo ? escapeHTML(v.marca_modelo) : 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Ano/Modelo:</strong><p>${v.ano_modelo ? escapeHTML(v.ano_modelo) : 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Cor:</strong><p>${v.cor ? escapeHTML(v.cor) : 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Combustível:</strong><p>${v.combustivel ? escapeHTML(v.combustivel) : 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Renavam:</strong><p>${v.renavam ? escapeHTML(v.renavam) : 'N/A'}</p></div>
                        <div class="col-span-2"><strong class="block text-gray-500">Chassi:</strong><p>${v.chassi ? escapeHTML(v.chassi) : 'N/A'}</p></div>
                    </div>
                `;
                document.getElementById('details-modal').classList.add('flex');
            } else {
                alert('Não foi possível carregar os detalhes do veículo.');
            }
        }

        function escapeHTML(str) {
            if (str === null || typeof str === 'undefined') {
                return '';
            }
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(str));
            return div.innerHTML;
        }

        function fecharModalDetalhes() { toggleDetailsModal(false); }
    </script>

    <div id="details-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Detalhes do Veículo</p>
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