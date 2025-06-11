<?php
// ARQUIVO: index.php
// Descrição: Interface principal do sistema.
// Contém o formulário de cadastro, a lista de pessoas e os modais de edição/exclusão.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Cadastro de Pessoas</title>
    <!-- Incluindo o Tailwind CSS para um design moderno -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        /* Estilos personalizados para melhorar a aparência */
        body { font-family: 'Inter', sans-serif; }
        .modal {
            transition: opacity 0.25s ease;
            visibility: hidden;
            opacity: 0;
        }
        .modal.is-visible {
            visibility: visible;
            opacity: 1;
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
                    <a href="veiculos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Veículos</a>
                    <a href="objetos.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Objetos</a>
                    <a href="telefones.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Telefones</a>
                    <a href="analise.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Análise de Vínculos</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">

        <!-- Cabeçalho -->
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Sistema de Análise de Vínculos (SAVIP)</h1>
            <p class="text-gray-500 mt-1">Módulo de Cadastro de Pessoas</p>
        </header>

        <!-- Formulário de Cadastro -->
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Adicionar Nova Pessoa</h2>
            <form id="form-add-pessoa">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Coluna 1 -->
                    <div>
                        <label for="nome_completo" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                        <input type="text" id="nome_completo" name="nome_completo" class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label for="alcunha" class="block text-sm font-medium text-gray-700 mb-1">Alcunha (Apelido)</label>
                        <input type="text" id="alcunha" name="alcunha" class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="cpf" class="block text-sm font-medium text-gray-700 mb-1">CPF</label>
                        <input type="text" id="cpf" name="cpf" class="w-full p-2 border border-gray-300 rounded-md shadow-sm" placeholder="123.456.789-00">
                    </div>
                    <!-- Coluna 2 -->
                    <div>
                        <label for="rg" class="block text-sm font-medium text-gray-700 mb-1">RG</label>
                        <input type="text" id="rg" name="rg" class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                     <div>
                        <label for="sexo" class="block text-sm font-medium text-gray-700 mb-1">Sexo</label>
                        <select id="sexo" name="sexo" class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                            <option value="Masculino">Masculino</option>
                            <option value="Feminino">Feminino</option>
                        </select>
                    </div>
                    <div>
                        <label for="data_nascimento" class="block text-sm font-medium text-gray-700 mb-1">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                     <!-- Coluna 3 -->
                    <div>
                        <label for="nome_pai" class="block text-sm font-medium text-gray-700 mb-1">Nome do Pai</label>
                        <input type="text" id="nome_pai" name="nome_pai" class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="nome_mae" class="block text-sm font-medium text-gray-700 mb-1">Nome da Mãe</label>
                        <input type="text" id="nome_mae" name="nome_mae" class="w-full p-2 border border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105">
                        Salvar Pessoa
                    </button>
                </div>
            </form>
        </div>

        <!-- Lista de Pessoas Cadastradas -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
             <h2 class="text-2xl font-semibold mb-6">Pessoas Cadastradas</h2>
             <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase">Nome</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase">Alcunha</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase">CPF</th>
                            <th class="py-3 px-4 text-center text-xs font-semibold text-gray-600 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="lista-pessoas" class="text-gray-700">
                        <!-- Os dados serão carregados aqui via JavaScript -->
                        <tr><td colspan="4" class="text-center p-8">Carregando pessoas...</td></tr>
                    </tbody>
                </table>
             </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    <div id="edit-modal" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-70" onclick="toggleEditModal(false)"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-3xl mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Editar Pessoa</p>
                    <div class="modal-close cursor-pointer z-50" onclick="toggleEditModal(false)">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
                    </div>
                </div>
                <form id="form-edit-pessoa">
                    <input type="hidden" id="edit_pessoa_id" name="id">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div><label for="edit_nome_completo" class="block text-sm font-medium text-gray-700">Nome Completo</label><input type="text" id="edit_nome_completo" name="nome_completo" class="mt-1 w-full p-2 border border-gray-300 rounded-md" required></div>
                        <div><label for="edit_alcunha" class="block text-sm font-medium text-gray-700">Alcunha</label><input type="text" id="edit_alcunha" name="alcunha" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                        <div><label for="edit_cpf" class="block text-sm font-medium text-gray-700">CPF</label><input type="text" id="edit_cpf" name="cpf" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                        <div><label for="edit_rg" class="block text-sm font-medium text-gray-700">RG</label><input type="text" id="edit_rg" name="rg" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                        <div><label for="edit_sexo" class="block text-sm font-medium text-gray-700">Sexo</label><select id="edit_sexo" name="sexo" class="mt-1 w-full p-2 border border-gray-300 rounded-md"><option value="Masculino">Masculino</option><option value="Feminino">Feminino</option></select></div>
                        <div><label for="edit_data_nascimento" class="block text-sm font-medium text-gray-700">Data Nascimento</label><input type="date" id="edit_data_nascimento" name="data_nascimento" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                        <div><label for="edit_nome_pai" class="block text-sm font-medium text-gray-700">Nome do Pai</label><input type="text" id="edit_nome_pai" name="nome_pai" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                        <div><label for="edit_nome_mae" class="block text-sm font-medium text-gray-700">Nome da Mãe</label><input type="text" id="edit_nome_mae" name="nome_mae" class="mt-1 w-full p-2 border border-gray-300 rounded-md"></div>
                    </div>
                    <div class="flex justify-end pt-4 mt-4 border-t">
                        <button type="button" class="px-4 bg-gray-200 p-3 rounded-lg text-gray-700 hover:bg-gray-300 mr-2" onclick="toggleEditModal(false)">Cancelar</button>
                        <button type="submit" class="px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-600">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal de Confirmação de Exclusão -->
    <div id="delete-modal" class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center">
         <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-70" onclick="toggleDeleteModal(false)"></div>
        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold text-red-600">Confirmar Exclusão</p>
                    <div class="modal-close cursor-pointer z-50" onclick="toggleDeleteModal(false)">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
                    </div>
                </div>
                <p id="delete-message">Você tem certeza que deseja excluir este registro? Esta ação é irreversível.</p>
                <div class="flex justify-end pt-4 mt-4 border-t">
                    <button class="px-4 bg-gray-200 p-3 rounded-lg text-gray-700 hover:bg-gray-300 mr-2" onclick="toggleDeleteModal(false)">Cancelar</button>
                    <button id="confirm-delete-btn" class="px-4 bg-red-600 p-3 rounded-lg text-white hover:bg-red-700">Sim, Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Notificações (Toast) -->
    <div id="notification-toast" class="modal fixed bottom-5 right-5 bg-green-500 text-white py-3 px-5 rounded-lg shadow-lg">
        <p id="notification-message">Operação realizada com sucesso!</p>
    </div>

    <script>
        // URL da nossa API
        const API_URL = 'api.php';

        // --- Seletores de Elementos do DOM ---
        const addForm = document.getElementById('form-add-pessoa');
        const editForm = document.getElementById('form-edit-pessoa');
        const listaPessoas = document.getElementById('lista-pessoas');
        
        // Modais
        const editModal = document.getElementById('edit-modal');
        const deleteModal = document.getElementById('delete-modal');
        const notificationToast = document.getElementById('notification-toast');
        const notificationMessage = document.getElementById('notification-message');
        const deleteMessage = document.getElementById('delete-message');
        const confirmDeleteBtn = document.getElementById('confirm-delete-btn');

        // --- Funções dos Modais ---
        function toggleModal(modal, show) {
            if (show) modal.classList.add('is-visible');
            else modal.classList.remove('is-visible');
        }

        function showNotification(message, isSuccess = true) {
            notificationMessage.textContent = message;
            notificationToast.className = `modal fixed bottom-5 right-5 text-white py-3 px-5 rounded-lg shadow-lg ${isSuccess ? 'bg-green-500' : 'bg-red-500'}`;
            toggleModal(notificationToast, true);
            setTimeout(() => toggleModal(notificationToast, false), 3000);
        }

        const toggleEditModal = (show) => toggleModal(editModal, show);
        const toggleDeleteModal = (show) => toggleModal(deleteModal, show);

        // --- Funções CRUD (JavaScript) ---

        // READ: Carregar e exibir as pessoas
        async function carregarPessoas() {
            try {
                const response = await fetch(`${API_URL}?action=getPessoas`);
                if (!response.ok) throw new Error(`Erro HTTP: ${response.status}`);
                const pessoas = await response.json();

                listaPessoas.innerHTML = '';
                if (pessoas.length === 0) {
                     listaPessoas.innerHTML = '<tr><td colspan="4" class="text-center p-8">Nenhuma pessoa cadastrada ainda.</td></tr>';
                } else {
                    pessoas.forEach(pessoa => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-b border-gray-200 hover:bg-gray-50';
                        tr.innerHTML = `
                            <td class="py-3 px-4">${pessoa.nome_completo}</td>
                            <td class="py-3 px-4">${pessoa.alcunha || 'N/A'}</td>
                            <td class="py-3 px-4">${pessoa.cpf || 'N/A'}</td>
                            <td class="py-3 px-4 text-center">
                                <button onclick="abrirModalEdicao(${pessoa.id})" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-md text-sm">Editar</button>
                                <button onclick="abrirModalExclusao(${pessoa.id}, '${pessoa.nome_completo}')" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-md text-sm ml-2">Excluir</button>
                            </td>
                        `;
                        listaPessoas.appendChild(tr);
                    });
                }
            } catch (error) {
                console.error('Erro ao carregar pessoas:', error);
                showNotification('Erro ao carregar os dados. Verifique o console.', false);
            }
        }

        // CREATE: Adicionar uma nova pessoa
        async function adicionarPessoa(event) {
            event.preventDefault();
            const formData = new FormData(addForm);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch(`${API_URL}?action=addPessoa`, {
                    method: 'POST', body: JSON.stringify(data)
                });
                const result = await response.json();

                if (result.success) {
                    showNotification('Pessoa cadastrada com sucesso!');
                    addForm.reset();
                    carregarPessoas();
                } else {
                    showNotification(result.message || 'Ocorreu um erro desconhecido.', false);
                }
            } catch (error) {
                 showNotification('Erro de conexão com o servidor.', false);
            }
        }

        // UPDATE (Parte 1): Abrir modal e buscar dados
        async function abrirModalEdicao(id) {
            try {
                const response = await fetch(`${API_URL}?action=getPessoaById&id=${id}`);
                const pessoa = await response.json();
                if(pessoa){
                    // Preenche o formulário de edição com os dados retornados
                    document.getElementById('edit_pessoa_id').value = pessoa.id;
                    document.getElementById('edit_nome_completo').value = pessoa.nome_completo;
                    document.getElementById('edit_alcunha').value = pessoa.alcunha;
                    document.getElementById('edit_cpf').value = pessoa.cpf;
                    document.getElementById('edit_rg').value = pessoa.rg;
                    document.getElementById('edit_sexo').value = pessoa.sexo;
                    document.getElementById('edit_data_nascimento').value = pessoa.data_nascimento;
                    document.getElementById('edit_nome_pai').value = pessoa.nome_pai;
                    document.getElementById('edit_nome_mae').value = pessoa.nome_mae;
                    toggleEditModal(true);
                } else {
                    showNotification('Pessoa não encontrada.', false);
                }
            } catch (error) {
                showNotification('Erro ao buscar dados para edição.', false);
            }
        }

        // UPDATE (Parte 2): Salvar as alterações
        async function salvarAlteracoes(event) {
            event.preventDefault();
            const formData = new FormData(editForm);
            const data = Object.fromEntries(formData.entries());

            try {
                const response = await fetch(`${API_URL}?action=updatePessoa`, {
                    method: 'POST', body: JSON.stringify(data)
                });
                const result = await response.json();
                if (result.success) {
                    toggleEditModal(false);
                    showNotification('Dados atualizados com sucesso!');
                    carregarPessoas();
                } else {
                    showNotification(result.message || 'Erro ao atualizar dados.', false);
                }
            } catch(error) {
                showNotification('Erro de conexão com o servidor.', false);
            }
        }

        // DELETE (Parte 1): Abrir modal de confirmação
        function abrirModalExclusao(id, nome) {
            deleteMessage.textContent = `Você tem certeza que deseja excluir ${nome}? Esta ação é irreversível.`;
            confirmDeleteBtn.dataset.id = id; // Armazena o ID no botão
            toggleDeleteModal(true);
        }

        // DELETE (Parte 2): Executar a exclusão
        async function excluirPessoa() {
            const id = confirmDeleteBtn.dataset.id;
            try {
                const response = await fetch(`${API_URL}?action=deletePessoa`, {
                    method: 'POST', body: JSON.stringify({ id: id })
                });
                const result = await response.json();
                if (result.success) {
                    toggleDeleteModal(false);
                    showNotification('Pessoa excluída com sucesso!');
                    carregarPessoas();
                } else {
                    showNotification(result.message || 'Erro ao excluir pessoa.', false);
                }
            } catch(error) {
                showNotification('Erro de conexão com o servidor.', false);
            }
        }
        
        // --- Listeners de Eventos ---
        addForm.addEventListener('submit', adicionarPessoa);
        editForm.addEventListener('submit', salvarAlteracoes);
        confirmDeleteBtn.addEventListener('click', excluirPessoa);
        document.addEventListener('DOMContentLoaded', carregarPessoas);

    </script>
</body>
</html>