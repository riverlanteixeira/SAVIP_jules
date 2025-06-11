<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Cadastro de Objetos</title>
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
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Objetos</h1>
            <p class="text-gray-500 mt-1">Cadastre, edite e gerencie objetos de interesse.</p>
        </header>
        
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Adicionar Novo Objeto</h2>
            <form id="form-add-objeto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div><label for="tipo" class="block text-sm font-medium">Tipo de Objeto</label><input type="text" id="tipo" name="tipo" placeholder="Ex: Celular, Arma de Fogo" class="mt-1 w-full p-2 border rounded" required></div>
                    <div><label for="marca" class="block text-sm font-medium">Marca</label><input type="text" id="marca" name="marca" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="modelo" class="block text-sm font-medium">Modelo</label><input type="text" id="modelo" name="modelo" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="numero_serie" class="block text-sm font-medium">Nº de Série</label><input type="text" id="numero_serie" name="numero_serie" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="quantidade" class="block text-sm font-medium">Quantidade</label><input type="number" id="quantidade" name="quantidade" value="1" class="mt-1 w-full p-2 border rounded" required></div>
                    <div class="md:col-span-2 lg:col-span-3"><label for="observacoes" class="block text-sm font-medium">Observações</label><textarea id="observacoes" name="observacoes" rows="3" class="mt-1 w-full p-2 border rounded"></textarea></div>
                </div>
                <div class="mt-8 text-right"><button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar Objeto</button></div>
            </form>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
             <h2 class="text-2xl font-semibold mb-6">Objetos Cadastrados</h2>
             <div class="overflow-x-auto">
                <table class="min-w-full bg-white"><thead class="bg-gray-200"><tr><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Tipo</th><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Marca/Modelo</th><th class="py-3 px-4 text-left uppercase text-xs font-semibold">Nº Série</th><th class="py-3 px-4 text-center uppercase text-xs font-semibold">Ações</th></tr></thead><tbody id="lista-objetos"></tbody></table>
             </div>
        </div>
    </div>

    <div id="edit-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-3xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6"><div class="flex justify-between items-center pb-3 border-b"><p class="text-2xl font-bold">Editar Objeto</p><div class="cursor-pointer z-50" onclick="toggleModal(false)"><span class="text-3xl">&times;</span></div></div>
            <form id="form-edit-objeto" class="py-4">
                <input type="hidden" id="edit_objeto_id" name="id">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div><label for="edit_tipo" class="block text-sm font-medium">Tipo</label><input type="text" id="edit_tipo" name="tipo" class="mt-1 w-full p-2 border rounded" required></div>
                    <div><label for="edit_marca" class="block text-sm font-medium">Marca</label><input type="text" id="edit_marca" name="marca" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_modelo" class="block text-sm font-medium">Modelo</label><input type="text" id="edit_modelo" name="modelo" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_numero_serie" class="block text-sm font-medium">Nº de Série</label><input type="text" id="edit_numero_serie" name="numero_serie" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="edit_quantidade" class="block text-sm font-medium">Quantidade</label><input type="number" id="edit_quantidade" name="quantidade" class="mt-1 w-full p-2 border rounded" required></div>
                    <div class="md:col-span-2 lg:col-span-3"><label for="edit_observacoes" class="block text-sm font-medium">Observações</label><textarea id="edit_observacoes" name="observacoes" rows="3" class="mt-1 w-full p-2 border rounded"></textarea></div>
                </div>
                <div class="flex justify-end pt-4 mt-4 border-t"><button type="button" class="px-4 bg-gray-200 p-3 rounded-lg mr-2" onclick="toggleModal(false)">Cancelar</button><button type="submit" class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Alterações</button></div>
            </form>
        </div></div>
    </div>
    
    <script>
        const API_URL = 'api.php';
        const addForm = document.getElementById('form-add-objeto');
        const editForm = document.getElementById('form-edit-objeto');
        const listaObjetos = document.getElementById('lista-objetos');
        const editModal = document.getElementById('edit-modal');

        function toggleModal(show) { if (show) editModal.classList.add('flex'); else editModal.classList.remove('flex'); }

        async function carregarObjetos() {
            try {
                const response = await fetch(`${API_URL}?action=getObjetos`);
                const objetos = await response.json();
                listaObjetos.innerHTML = '';
                if (objetos.length > 0) {
                    objetos.forEach(o => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-b hover:bg-gray-50';
                        tr.innerHTML = `
                            <td class="py-3 px-4">${o.tipo || 'N/A'}</td>
                            <td class="py-3 px-4">${(o.marca || '') + ' ' + (o.modelo || '')}</td>
                            <td class="py-3 px-4">${o.numero_serie || 'N/A'}</td>
                            <td class="py-3 px-4 text-center">
                                <button onclick="abrirModalDetalhes(${o.id})" class="bg-blue-500 text-white font-bold py-1 px-2 text-xs rounded">Detalhes</button>
                                <button onclick="abrirModalEdicao(${o.id})" class="bg-yellow-500 text-white font-bold py-1 px-2 text-xs rounded ml-2">Editar</button>
                                <button onclick="excluirObjeto(${o.id})" class="bg-red-600 text-white font-bold py-1 px-2 text-xs rounded ml-2">Excluir</button>
                            </td>
                        `;
                        listaObjetos.appendChild(tr);
                    });
                } else {
                    listaObjetos.innerHTML = '<tr><td colspan="4" class="text-center p-8">Nenhum objeto cadastrado.</td></tr>';
                }
            } catch (error) { console.error("Erro ao carregar objetos:", error); }
        }

        addForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(addForm);
            const data = Object.fromEntries(formData.entries());
            const response = await fetch(`${API_URL}?action=addObjeto`, { method: 'POST', body: JSON.stringify(data) });
            const result = await response.json();
            if (result.success) { addForm.reset(); carregarObjetos(); } else { alert('Erro: ' + result.message); }
        });

        async function abrirModalEdicao(id) {
            const response = await fetch(`${API_URL}?action=getObjetoById&id=${id}`);
            const o = await response.json();
            if(o){
                document.getElementById('edit_objeto_id').value = o.id;
                document.getElementById('edit_tipo').value = o.tipo;
                document.getElementById('edit_marca').value = o.marca;
                document.getElementById('edit_modelo').value = o.modelo;
                document.getElementById('edit_numero_serie').value = o.numero_serie;
                document.getElementById('edit_quantidade').value = o.quantidade;
                document.getElementById('edit_observacoes').value = o.observacoes;
                toggleModal(true);
            }
        }
        
        editForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(editForm);
            const data = Object.fromEntries(formData.entries());
            const response = await fetch(`${API_URL}?action=updateObjeto`, { method: 'POST', body: JSON.stringify(data) });
            const result = await response.json();
            if(result.success) { toggleModal(false); carregarObjetos(); } else { alert('Erro: ' + result.message); }
        });

        async function excluirObjeto(id) {
            if (!confirm('Tem certeza que deseja excluir este objeto?')) return;
            const response = await fetch(`${API_URL}?action=deleteObjeto`, { method: 'POST', body: JSON.stringify({ id: id }) });
            const result = await response.json();
            if (result.success) { carregarObjetos(); } else { alert('Erro: ' + result.message); }
        }

        document.addEventListener('DOMContentLoaded', carregarObjetos);

        async function abrirModalDetalhes(id) {
            const response = await fetch(`${API_URL}?action=getObjetoById&id=${id}`);
            const o = await response.json();
            const detailsContent = document.getElementById('details-content');
            
            if (o) {
                detailsContent.innerHTML = `
                    <div class="space-y-3 text-sm">
                        <div><strong class="block text-gray-500">Tipo:</strong><p>${o.tipo || 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Marca:</strong><p>${o.marca || 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Modelo:</strong><p>${o.modelo || 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Nº de Série:</strong><p>${o.numero_serie || 'N/A'}</p></div>
                        <div><strong class="block text-gray-500">Quantidade:</strong><p>${o.quantidade || 'N/A'}</p></div>
                        <div class="col-span-2"><strong class="block text-gray-500">Observações:</strong><p class="whitespace-pre-wrap">${o.observacoes || 'N/A'}</p></div>
                    </div>
                `;
                document.getElementById('details-modal').classList.add('flex');
            } else {
                alert('Não foi possível carregar os detalhes do objeto.');
            }
        }
    </script>

    <div id="details-modal" class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Detalhes do Objeto</p>
                    <div class="cursor-pointer z-50" onclick="document.getElementById('details-modal').classList.remove('flex')">
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