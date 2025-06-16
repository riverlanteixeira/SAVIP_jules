<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Cadastro de Pessoas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .modal {
            display: none;
        }

        .modal.flex {
            display: flex;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

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
            <h1 class="text-3xl font-bold text-gray-700">Módulo de Cadastro de Pessoas</h1>
            <p class="text-gray-500 mt-1">Gerencie os indivíduos da sua investigação.</p>
        </header>

        <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-6">Adicionar Nova Pessoa</h2>
            <form id="form-add-pessoa" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="lg:col-span-4">
                        <h4 class="font-semibold text-lg border-b pb-1">Dados Pessoais</h4>
                    </div>
                    <div><label for="nome_completo" class="block text-sm font-medium">Nome Completo</label><input
                            type="text" id="nome_completo" name="nome_completo" class="mt-1 w-full p-2 border rounded"
                            required></div>
                    <div><label for="alcunha" class="block text-sm font-medium">Alcunha</label><input type="text"
                            id="alcunha" name="alcunha" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="cpf" class="block text-sm font-medium">CPF</label><input type="text" id="cpf"
                            name="cpf" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="rg" class="block text-sm font-medium">RG</label><input type="text" id="rg"
                            name="rg" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="sexo" class="block text-sm font-medium">Sexo</label><select id="sexo" name="sexo"
                            class="mt-1 w-full p-2 border rounded">
                            <option>Masculino</option>
                            <option>Feminino</option>
                        </select></div>
                    <div><label for="data_nascimento" class="block text-sm font-medium">Nascimento</label><input
                            type="date" id="data_nascimento" name="data_nascimento"
                            class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="naturalidade" class="block text-sm font-medium">Naturalidade</label><input
                            type="text" id="naturalidade" name="naturalidade" class="mt-1 w-full p-2 border rounded">
                    </div>
                    <div><label for="nacionalidade" class="block text-sm font-medium">Nacionalidade</label><input
                            type="text" id="nacionalidade" name="nacionalidade" value="Brasileira"
                            class="mt-1 w-full p-2 border rounded"></div>
                    <div class="md:col-span-2"><label for="nome_pai" class="block text-sm font-medium">Nome do
                            Pai</label><input type="text" id="nome_pai" name="nome_pai"
                            class="mt-1 w-full p-2 border rounded"></div>
                    <div class="md:col-span-2"><label for="nome_mae" class="block text-sm font-medium">Nome da
                            Mãe</label><input type="text" id="nome_mae" name="nome_mae"
                            class="mt-1 w-full p-2 border rounded"></div>

                    <div class="lg:col-span-4 mt-4">
                        <h4 class="font-semibold text-lg border-b pb-1">Características Físicas</h4>
                    </div>
                    <div><label for="cor_cabelo" class="block text-sm font-medium">Cor do Cabelo</label><input
                            type="text" id="cor_cabelo" name="cor_cabelo" class="mt-1 w-full p-2 border rounded"></div>
                    <div><label for="cor_olhos" class="block text-sm font-medium">Cor dos Olhos</label><input
                            type="text" id="cor_olhos" name="cor_olhos" class="mt-1 w-full p-2 border rounded"></div>
                    <div>
                        <label for="cor_pele" class="block text-sm font-medium">Cor da Pele</label>
                        <select id="cor_pele" name="cor_pele" class="mt-1 w-full p-2 border rounded">
                            <option>Branco</option>
                            <option>Negro</option>
                            <option>Indígena</option>
                            <option>Oriental</option>
                            <option>Pardo</option>
                        </select>
                    </div>
                    <div><label for="faixa_etaria" class="block text-sm font-medium">Faixa Etária</label><select
                            id="faixa_etaria" name="faixa_etaria" class="mt-1 w-full p-2 border rounded">
                            <option>Criança</option>
                            <option>Adolescente</option>
                            <option selected>Adulto</option>
                            <option>Idoso</option>
                        </select></div>

                    <div class="lg:col-span-4 mt-4">
                        <h4 class="font-semibold text-lg border-b pb-1">Histórico e Atuação</h4>
                    </div>
                    <div class="lg:col-span-2"><label for="historico_delitos"
                            class="block text-sm font-medium">Histórico de Delitos</label><textarea
                            id="historico_delitos" name="historico_delitos" rows="3"
                            class="mt-1 w-full p-2 border rounded"></textarea></div>
                    <div class="lg:col-span-2"><label for="atuacao_geografica" class="block text-sm font-medium">Área de
                            Atuação Geográfica</label><textarea id="atuacao_geografica" name="atuacao_geografica"
                            rows="3" class="mt-1 w-full p-2 border rounded"></textarea></div>
                    <div class="lg:col-span-2"><label for="sentencas"
                            class="block text-sm font-medium">Sentenças</label><textarea id="sentencas" name="sentencas"
                            rows="3" class="mt-1 w-full p-2 border rounded"></textarea></div>
                    <div class="lg:col-span-2"><label for="periodos_reclusao" class="block text-sm font-medium">Períodos
                            de Reclusão</label><textarea id="periodos_reclusao" name="periodos_reclusao" rows="3"
                            class="mt-1 w-full p-2 border rounded"></textarea></div>
                    <div class="lg:col-span-4"><label for="redes_sociais" class="block text-sm font-medium">Redes
                            Sociais (uma por linha)</label><textarea id="redes_sociais" name="redes_sociais" rows="3"
                            class="mt-1 w-full p-2 border rounded"></textarea></div>

                    <div class="lg:col-span-4 mt-4">
                        <h4 class="font-semibold text-lg border-b pb-1">Vínculos e Imagens</h4>
                    </div>
                    <div class="lg:col-span-2"><label for="afiliacoes"
                            class="block text-sm font-medium">Afiliações</label><select id="afiliacoes"
                            name="afiliacoes[]" multiple class="w-full p-2 border rounded h-32"></select></div>
                    <div class="lg:col-span-2"><label for="foto" class="block text-sm font-medium">Foto
                            Principal</label><input type="file" id="foto" name="foto"
                            class="mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="lg:col-span-4 mt-4 pt-4 border-t">
                        <label class="block text-sm font-medium mb-2">Tatuagens</label>
                        <div class="flex items-center space-x-2 mb-2">
                            <select id="tattoo-local" class="p-2 border rounded w-1/3">
                                <option>Rosto</option>
                                <option>Pescoço</option>
                                <option>Ombro Direito</option>
                                <option>Braço Direito</option>
                                <option>Antebraço Direito</option>
                                <option>Mão Direita</option>
                                <option>Ombro Esquerdo</option>
                                <option>Braço Esquerdo</option>
                                <option>Antebraço Esquerdo</option>
                                <option>Mão Esquerda</option>
                                <option>Peitoral</option>
                                <option>Abdome</option>
                                <option>Costas</option>
                                <option>Coxa Direita</option>
                                <option>Perna Direita</option>
                                <option>Pé Direito</option>
                                <option>Coxa Esquerda</option>
                                <option>Perna Esquerda</option>
                                <option>Pé Esquerdo</option>
                            </select>
                            <input type="text" id="tattoo-descricao" placeholder="Descrição da tatuagem"
                                class="p-2 border rounded flex-grow">
                            <button type="button" id="btn-add-tattoo"
                                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Adicionar</button>
                        </div>
                        <div id="lista-tatuagens" class="space-y-2"></div>
                    </div>
                </div>
                <div class="mt-8 text-right"><button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Salvar
                        Pessoa</button></div>
            </form>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-6">Pessoas Cadastradas</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-3 px-4 text-left uppercase text-xs font-semibold">Nome</th>
                            <th class="py-3 px-4 text-left uppercase text-xs font-semibold">Alcunha</th>
                            <th class="py-3 px-4 text-left uppercase text-xs font-semibold">CPF</th>
                            <th class="py-3 px-4 text-center uppercase text-xs font-semibold">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="lista-pessoas"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="details-modal"
        class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-3xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Detalhes da Pessoa</p>
                    <div class="cursor-pointer z-50" onclick="toggleModal('details-modal', false)"><span
                            class="text-3xl">&times;</span></div>
                </div>
                <div id="details-content" class="my-4 space-y-4"></div>
                <div class="flex justify-end pt-2 border-t"><button class="px-4 bg-gray-500 p-3 rounded-lg text-white"
                        onclick="toggleModal('details-modal', false)">Fechar</button></div>
            </div>
        </div>
    </div>

    <div id="edit-modal"
        class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-4xl mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 px-6 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center pb-3 border-b">
                    <p class="text-2xl font-bold">Editar Pessoa</p>
                    <div class="cursor-pointer z-50" onclick="toggleModal('edit-modal', false)"><span
                            class="text-3xl">&times;</span></div>
                </div>
                <form id="form-edit-pessoa" enctype="multipart/form-data" class="mt-4">
                    <input type="hidden" id="edit_pessoa_id" name="id">
                    <input type="hidden" id="edit_foto_existente" name="foto_existente">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="lg:col-span-4">
                            <h4 class="font-semibold text-lg border-b pb-1">Dados Pessoais</h4>
                        </div>
                        <div><label for="edit_nome_completo" class="block text-sm font-medium">Nome</label><input
                                type="text" id="edit_nome_completo" name="nome_completo" class="mt-1 w-full p-2 border"
                                required></div>
                        <div><label for="edit_alcunha" class="block text-sm font-medium">Alcunha</label><input
                                type="text" id="edit_alcunha" name="alcunha" class="mt-1 w-full p-2 border"></div>
                        <div><label for="edit_cpf" class="block text-sm font-medium">CPF</label><input type="text"
                                id="edit_cpf" name="cpf" class="mt-1 w-full p-2 border"></div>
                        <div><label for="edit_rg" class="block text-sm font-medium">RG</label><input type="text"
                                id="edit_rg" name="rg" class="mt-1 w-full p-2 border"></div>
                        <div><label for="edit_sexo" class="block text-sm font-medium">Sexo</label><select id="edit_sexo"
                                name="sexo" class="mt-1 w-full p-2 border">
                                <option>Masculino</option>
                                <option>Feminino</option>
                            </select></div>
                        <div><label for="edit_data_nascimento"
                                class="block text-sm font-medium">Nascimento</label><input type="date"
                                id="edit_data_nascimento" name="data_nascimento" class="mt-1 w-full p-2 border"></div>
                        <div><label for="edit_naturalidade" class="block text-sm font-medium">Naturalidade</label><input
                                type="text" id="edit_naturalidade" name="naturalidade" class="mt-1 w-full p-2 border">
                        </div>
                        <div><label for="edit_nacionalidade"
                                class="block text-sm font-medium">Nacionalidade</label><input type="text"
                                id="edit_nacionalidade" name="nacionalidade" class="mt-1 w-full p-2 border"></div>
                        <div class="md:col-span-2"><label for="edit_nome_pai"
                                class="block text-sm font-medium">Pai</label><input type="text" id="edit_nome_pai"
                                name="nome_pai" class="mt-1 w-full p-2 border"></div>
                        <div class="md:col-span-2"><label for="edit_nome_mae"
                                class="block text-sm font-medium">Mãe</label><input type="text" id="edit_nome_mae"
                                name="nome_mae" class="mt-1 w-full p-2 border"></div>

                        <div class="lg:col-span-4 mt-4">
                            <h4 class="font-semibold text-lg border-b pb-1">Características Físicas</h4>
                        </div>
                        <div><label for="edit_cor_cabelo" class="block text-sm font-medium">Cor do Cabelo</label><input
                                type="text" id="edit_cor_cabelo" name="cor_cabelo" class="mt-1 w-full p-2 border"></div>
                        <div><label for="edit_cor_olhos" class="block text-sm font-medium">Cor dos Olhos</label><input
                                type="text" id="edit_cor_olhos" name="cor_olhos" class="mt-1 w-full p-2 border"></div>
                        <div>
                            <label for="edit_cor_pele" class="block text-sm font-medium">Cor da Pele</label>
                            <select id="edit_cor_pele" name="cor_pele" class="mt-1 w-full p-2 border rounded">
                                <option>Branco</option>
                                <option>Negro</option>
                                <option>Indígena</option>
                                <option>Oriental</option>
                                <option>Pardo</option>
                            </select>
                        </div>
                        <div><label for="edit_faixa_etaria" class="block text-sm font-medium">Faixa
                                Etária</label><select id="edit_faixa_etaria" name="faixa_etaria"
                                class="mt-1 w-full p-2 border">
                                <option>Criança</option>
                                <option>Adolescente</option>
                                <option>Adulto</option>
                                <option>Idoso</option>
                            </select></div>

                        <div class="lg:col-span-4 mt-4">
                            <h4 class="font-semibold text-lg border-b pb-1">Histórico e Atuação</h4>
                        </div>
                        <div class="lg:col-span-2"><label for="edit_historico_delitos"
                                class="block text-sm font-medium">Histórico de Delitos</label><textarea
                                id="edit_historico_delitos" name="historico_delitos" rows="3"
                                class="mt-1 w-full p-2 border rounded"></textarea></div>
                        <div class="lg:col-span-2"><label for="edit_atuacao_geografica"
                                class="block text-sm font-medium">Área de Atuação</label><textarea
                                id="edit_atuacao_geografica" name="atuacao_geografica" rows="3"
                                class="mt-1 w-full p-2 border rounded"></textarea></div>
                        <div class="lg:col-span-2"><label for="edit_sentencas"
                                class="block text-sm font-medium">Sentenças</label><textarea id="edit_sentencas"
                                name="sentencas" rows="3" class="mt-1 w-full p-2 border rounded"></textarea></div>
                        <div class="lg:col-span-2"><label for="edit_periodos_reclusao"
                                class="block text-sm font-medium">Períodos de Reclusão</label><textarea
                                id="edit_periodos_reclusao" name="periodos_reclusao" rows="3"
                                class="mt-1 w-full p-2 border rounded"></textarea></div>
                        <div class="lg:col-span-4"><label for="edit_redes_sociais"
                                class="block text-sm font-medium">Redes Sociais</label><textarea id="edit_redes_sociais"
                                name="redes_sociais" rows="3" class="mt-1 w-full p-2 border rounded"></textarea></div>

                        <div class="lg:col-span-4 mt-4">
                            <h4 class="font-semibold text-lg border-b pb-1">Vínculos e Imagens</h4>
                        </div>
                        <div class="lg:col-span-2"><label for="edit_afiliacoes"
                                class="block text-sm font-medium">Afiliações</label><select id="edit_afiliacoes"
                                name="afiliacoes[]" multiple class="w-full p-2 border h-32"></select></div>
                        <div class="lg:col-span-2"><label class="block text-sm font-medium">Foto Principal</label><img
                                id="edit_foto_preview" src=""
                                class="w-24 h-24 object-cover rounded-md my-2 hidden"><input type="file" id="edit_foto"
                                name="foto" class="mt-1 w-full text-sm"></div>

                        <div class="lg:col-span-4 mt-4 pt-4 border-t">
                            <label class="block text-sm font-medium mb-2">Tatuagens</label>
                            <div class="flex items-center space-x-2 mb-2">
                                <select id="edit_tattoo-local" class="p-2 border rounded w-1/3">
                                    <option>Rosto</option>
                                    <option>Pescoço</option>
                                    <option>Ombro Direito</option>
                                    <option>Braço Direito</option>
                                    <option>Antebraço Direito</option>
                                    <option>Mão Direita</option>
                                    <option>Ombro Esquerdo</option>
                                    <option>Braço Esquerdo</option>
                                    <option>Antebraço Esquerdo</option>
                                    <option>Mão Esquerda</option>
                                    <option>Peitoral</option>
                                    <option>Abdome</option>
                                    <option>Costas</option>
                                    <option>Coxa Direita</option>
                                    <option>Perna Direita</option>
                                    <option>Pé Direito</option>
                                    <option>Coxa Esquerda</option>
                                    <option>Perna Esquerda</option>
                                    <option>Pé Esquerdo</option>
                                </select>
                                <input type="text" id="edit_tattoo-descricao" placeholder="Descrição da tatuagem"
                                    class="p-2 border rounded flex-grow">
                                <button type="button" id="btn-edit-add-tattoo"
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Adicionar</button>
                            </div>
                            <div id="edit_lista-tatuagens" class="space-y-2"></div>
                        </div>
                    </div>
                    <div class="flex justify-end pt-4 mt-4 border-t"><button type="button"
                            class="px-4 bg-gray-200 p-3 rounded-lg mr-2"
                            onclick="toggleModal('edit-modal', false)">Cancelar</button><button type="submit"
                            class="px-4 bg-blue-600 p-3 rounded-lg text-white">Salvar Alterações</button></div>
                </form>
            </div>
        </div>
    </div>

    <div id="delete-modal"
        class="modal fixed w-full h-full top-0 left-0 items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded-lg shadow-lg z-50">
            <div class="py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold text-red-600">Confirmar Exclusão</p>
                    <div class="cursor-pointer z-50" onclick="toggleModal('delete-modal', false)"><span
                            class="text-3xl">&times;</span></div>
                </div>
                <p id="delete-message"></p>
                <div class="flex justify-end pt-4 mt-4 border-t"><button class="px-4 bg-gray-200 p-3 rounded-lg mr-2"
                        onclick="toggleModal('delete-modal', false)">Cancelar</button><button id="confirm-delete-btn"
                        class="px-4 bg-red-600 p-3 rounded-lg text-white">Sim, Excluir</button></div>
            </div>
        </div>
    </div>

    <script>
        const API_URL = 'api.php';
        const addForm = document.getElementById('form-add-pessoa');
        const editForm = document.getElementById('form-edit-pessoa');
        const listaPessoas = document.getElementById('lista-pessoas');
        const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
        let todasOrganizacoes = [];
        let tatuagensAdd = [], tatuagensEdit = [];

        function toggleModal(modalId, show) { const modal = document.getElementById(modalId); if (show) modal.classList.add('flex'); else modal.classList.remove('flex'); }

        function escapeHTML(str) {
            if (str === null || typeof str === 'undefined') return '';
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(String(str)));
            return div.innerHTML;
        }

        function renderTatuagens(mode) {
            const isEdit = mode === 'edit';
            const listaEl = document.getElementById(isEdit ? 'edit_lista-tatuagens' : 'lista-tatuagens');
            const tatuagens = isEdit ? tatuagensEdit : tatuagensAdd;
            const removeFn = isEdit ? 'removerTatuagemEdit' : 'removerTatuagemAdd';
            listaEl.innerHTML = '';
            tatuagens.forEach((tattoo, index) => {
                const div = document.createElement('div');
                div.className = 'p-2 bg-gray-100 rounded flex justify-between items-center text-sm';
                div.innerHTML = `<span><strong>${escapeHTML(tattoo.local_corpo)}:</strong> ${escapeHTML(tattoo.descricao)}</span><button type="button" onclick="${removeFn}(${index})" class="text-red-500 font-bold px-2">X</button>`;
                listaEl.appendChild(div);
            });
        }

        function adicionarTatuagemAdd() {
            const localEl = document.getElementById('tattoo-local');
            const descEl = document.getElementById('tattoo-descricao');
            if (!descEl || descEl.value.trim() === '') return;
            const tattoo = { local_corpo: localEl.value, descricao: descEl.value };
            tatuagensAdd.push(tattoo);
            renderTatuagens('add');
            descEl.value = '';
        }

        function adicionarTatuagemEdit() {
            const localEl = document.getElementById('edit_tattoo-local');
            const descEl = document.getElementById('edit_tattoo-descricao');
            if (!descEl || descEl.value.trim() === '') return;
            const tattoo = { local_corpo: localEl.value, descricao: descEl.value };
            tatuagensEdit.push(tattoo);
            renderTatuagens('edit');
            descEl.value = '';
        }

        function removerTatuagemAdd(index) { tatuagensAdd.splice(index, 1); renderTatuagens('add'); }
        function removerTatuagemEdit(index) { tatuagensEdit.splice(index, 1); renderTatuagens('edit'); }

        async function carregarPessoas() {
            try {
                const response = await fetch(`${API_URL}?action=getPessoas`);
                const pessoas = await response.json();
                listaPessoas.innerHTML = '';
                if (pessoas.length > 0) {
                    pessoas.forEach(pessoa => {
                        const tr = document.createElement('tr');
                        tr.className = 'border-b hover:bg-gray-50';
                        tr.innerHTML = `<td class="py-3 px-4">${escapeHTML(pessoa.nome_completo)}</td><td class="py-3 px-4">${escapeHTML(pessoa.alcunha) || 'N/A'}</td><td class="py-3 px-4">${escapeHTML(pessoa.cpf) || 'N/A'}</td><td class="py-3 px-4 text-center"><a href="gerar_dossie_pessoa.php?id=${pessoa.id}" target="_blank" class="bg-green-600 text-white font-bold py-1 px-3 rounded-md text-sm">Dossiê</a><button onclick="abrirModalDetalhes(${pessoa.id})" class="bg-blue-500 text-white font-bold py-1 px-3 rounded-md text-sm ml-2">Detalhes</button><button onclick="abrirModalEdicao(${pessoa.id})" class="bg-yellow-500 text-white font-bold py-1 px-3 rounded-md text-sm ml-2">Editar</button><button onclick="abrirModalExclusao(${pessoa.id},'${escapeHTML(pessoa.nome_completo)}')" class="bg-red-600 text-white font-bold py-1 px-3 rounded-md text-sm ml-2">Excluir</button></td>`;
                        listaPessoas.appendChild(tr);
                    });
                }
            } catch (error) { console.error("Erro ao carregar pessoas:", error); }
        }

        async function popularOrganizacoes() {
            try {
                const response = await fetch(`${API_URL}?action=getOrganizacoes`);
                todasOrganizacoes = await response.json();
                const selectAdd = document.getElementById('afiliacoes');
                const selectEdit = document.getElementById('edit_afiliacoes');
                selectAdd.innerHTML = ''; selectEdit.innerHTML = '';
                todasOrganizacoes.forEach(org => { const option = `<option value="${org.id}">${org.nome}</option>`; selectAdd.innerHTML += option; selectEdit.innerHTML += option; });
            } catch (error) { console.error("Erro ao popular organizações:", error); }
        }

        async function adicionarPessoa(e) {
            e.preventDefault();
            const formData = new FormData(addForm);
            const afiliacoes = Array.from(document.querySelectorAll('#afiliacoes option:checked')).map(el => el.value);
            formData.append('afiliacoes', afiliacoes.join(','));
            formData.append('tatuagens', JSON.stringify(tatuagensAdd));
            formData.append('action', 'addPessoa');
            try {
                const response = await fetch(API_URL, { method: 'POST', body: formData });
                const result = await response.json();
                if (result.success) { addForm.reset(); tatuagensAdd = []; renderTatuagens('add'); carregarPessoas(); alert('Pessoa adicionada!'); }
                else { alert('Erro: ' + (result.message || 'Erro desconhecido.')); }
            } catch (error) { console.error("Erro ao adicionar pessoa:", error); alert("Falha na comunicação com o servidor."); }
        }

        async function abrirModalEdicao(id) {
            try {
                const response = await fetch(`${API_URL}?action=getPessoaById&id=${id}`);
                const apiResponse = await response.json();

                if (apiResponse && apiResponse.success && apiResponse.data && apiResponse.data.pessoa) {
                    const p = apiResponse.data.pessoa;
                    const afiliacoesData = apiResponse.data.afiliacoes;
                    const tatuagensData = apiResponse.data.tatuagens;

                    document.getElementById('edit_pessoa_id').value = p.id;
                    document.getElementById('edit_nome_completo').value = p.nome_completo || '';
                    document.getElementById('edit_alcunha').value = p.alcunha || '';
                    document.getElementById('edit_cpf').value = p.cpf || '';
                    document.getElementById('edit_rg').value = p.rg || '';
                    document.getElementById('edit_sexo').value = p.sexo || 'Masculino';
                    document.getElementById('edit_data_nascimento').value = p.data_nascimento || '';
                    document.getElementById('edit_nome_pai').value = p.nome_pai || '';
                    document.getElementById('edit_nome_mae').value = p.nome_mae || '';
                    document.getElementById('edit_naturalidade').value = p.naturalidade || '';
                    document.getElementById('edit_nacionalidade').value = p.nacionalidade || '';
                    document.getElementById('edit_cor_cabelo').value = p.cor_cabelo || '';
                    document.getElementById('edit_cor_olhos').value = p.cor_olhos || '';
                    document.getElementById('edit_cor_pele').value = p.cor_pele || '';
                    document.getElementById('edit_faixa_etaria').value = p.faixa_etaria || 'Adulto';
                    document.getElementById('edit_historico_delitos').value = p.historico_delitos || '';
                    document.getElementById('edit_sentencas').value = p.sentencas || '';
                    document.getElementById('edit_periodos_reclusao').value = p.periodos_reclusao || '';
                    document.getElementById('edit_atuacao_geografica').value = p.atuacao_geografica || '';
                    document.getElementById('edit_redes_sociais').value = p.redes_sociais || '';
                    document.getElementById('edit_foto_existente').value = p.foto_path || '';

                    const preview = document.getElementById('edit_foto_preview');
                    if (p.foto_path && p.foto_path !== 'null') {
                        preview.src = p.foto_path;
                        preview.classList.remove('hidden');
                    } else {
                        preview.classList.add('hidden');
                    }

                    const selectEdit = document.getElementById('edit_afiliacoes');
                    Array.from(selectEdit.options).forEach(option => {
                        option.selected = afiliacoesData.includes(parseInt(option.value));
                    });
                    tatuagensEdit = tatuagensData || [];
                    renderTatuagens('edit');
                    toggleModal('edit-modal', true);
                } else {
                    alert('Erro ao carregar dados da pessoa: ' + (apiResponse.message || 'Resposta inesperada da API.'));
                }
            } catch (error) {
                console.error("Erro ao abrir modal de edição:", error);
                alert("Erro de comunicação ao buscar dados da pessoa.");
            }
        }

        async function salvarAlteracoes(e) {
            e.preventDefault();
            try {
                const formData = new FormData(editForm);
                const afiliacoes = Array.from(document.querySelectorAll('#edit_afiliacoes option:checked')).map(el => el.value);
                formData.append('afiliacoes', afiliacoes.join(','));
                formData.append('tatuagens', JSON.stringify(tatuagensEdit));
                formData.append('action', 'updatePessoa');
                const response = await fetch(API_URL, { method: 'POST', body: formData });
                const result = await response.json();
                if (result.success) { toggleModal('edit-modal', false); carregarPessoas(); alert('Pessoa atualizada!'); }
                else { alert('Erro: ' + (result.message || 'Erro desconhecido.')); }
            } catch (error) { console.error("Erro ao salvar alterações:", error); alert("Falha na comunicação com o servidor: " + error.message); }
        }

        function abrirModalExclusao(id, nome) {
            document.getElementById('delete-message').textContent = `Tem certeza que deseja excluir ${nome}?`;
            confirmDeleteBtn.dataset.id = id;
            toggleModal('delete-modal', true);
        }

        async function excluirPessoa() {
            const id = confirmDeleteBtn.dataset.id;
            try {
                const response = await fetch(`${API_URL}?action=deletePessoa`, { method: 'POST', body: JSON.stringify({ id: id }), headers: { 'Content-Type': 'application/json' } });
                const result = await response.json();
                if (result.success) { toggleModal('delete-modal', false); carregarPessoas(); }
                else { alert('Erro: ' + (result.message || 'Erro desconhecido.')); }
            } catch (error) { console.error("Erro ao excluir pessoa:", error); alert("Falha na comunicação com o servidor: " + error.message); }
        }

        //
        // >>> SUBSTITUA A FUNÇÃO abrirModalDetalhes PELA VERSÃO FINAL E COMPLETA ABAIXO <<<
        //
        async function abrirModalDetalhes(id) {
            toggleModal('details-modal', true);
            const detailsContent = document.getElementById('details-content');
            detailsContent.innerHTML = '<p>Carregando...</p>';
            const response = await fetch(`${API_URL}?action=getPessoaById&id=${id}`);
            const apiResponse = await response.json();

            if (apiResponse && apiResponse.success && apiResponse.data && apiResponse.data.pessoa) {
                const p = apiResponse.data.pessoa;
                const afiliacoesData = apiResponse.data.afiliacoes;
                const tatuagensData = apiResponse.data.tatuagens;

                // Seção da Foto e Dados Pessoais
                let html = `<div class="flex flex-col md:flex-row gap-6">`;
                if (p.foto_path && p.foto_path !== 'null') {
                    html += `<div><img src="${p.foto_path}" class="w-32 h-32 object-cover rounded-md"></div>`;
                }
                html += `<div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm w-full">
                    <div><strong>Nome:</strong><p>${escapeHTML(p.nome_completo)}</p></div>
                    <div><strong>Alcunha:</strong><p>${escapeHTML(p.alcunha)}</p></div>
                    <div><strong>CPF:</strong><p>${escapeHTML(p.cpf)}</p></div>
                    <div><strong>RG:</strong><p>${escapeHTML(p.rg)}</p></div>
                    <div><strong>Sexo:</strong><p>${escapeHTML(p.sexo)}</p></div>
                    <div><strong>Nascimento:</strong><p>${p.data_nascimento ? new Date(p.data_nascimento).toLocaleDateString('pt-BR') : 'N/A'}</p></div>
                    <div><strong>Naturalidade:</strong><p>${escapeHTML(p.naturalidade)}</p></div>
                    <div><strong>Nacionalidade:</strong><p>${escapeHTML(p.nacionalidade)}</p></div>
                 </div></div>`;

                // Seção de Filiação
                html += `<div class="mt-4 pt-4 border-t text-sm"><h4 class="font-semibold mb-2">Filiação</h4>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>Nome do Pai:</strong><p>${escapeHTML(p.nome_pai)}</p></div>
                    <div><strong>Nome da Mãe:</strong><p>${escapeHTML(p.nome_mae)}</p></div>
                 </div></div>`;

                // Seção de Características Físicas
                html += `<div class="mt-4 pt-4 border-t text-sm"><h4 class="font-semibold mb-2">Características Físicas</h4>
                 <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div><strong>Cor da Pele:</strong><p>${escapeHTML(p.cor_pele)}</p></div>
                    <div><strong>Cor do Cabelo:</strong><p>${escapeHTML(p.cor_cabelo)}</p></div>
                    <div><strong>Cor dos Olhos:</strong><p>${escapeHTML(p.cor_olhos)}</p></div>
                    <div><strong>Faixa Etária:</strong><p>${escapeHTML(p.faixa_etaria)}</p></div>
                 </div></div>`;

                // Seção de Histórico e Atuação
                html += `<div class="mt-4 pt-4 border-t text-sm">
                    <h4 class="font-semibold mb-2">Histórico e Atuação</h4>
                    <div class="space-y-3">
                        <div><strong>Histórico de Delitos:</strong><p class="whitespace-pre-wrap font-mono">${escapeHTML(p.historico_delitos)}</p></div>
                        <div><strong>Sentenças:</strong><p class="whitespace-pre-wrap font-mono">${escapeHTML(p.sentencas)}</p></div>
                        <div><strong>Períodos de Reclusão:</strong><p class="whitespace-pre-wrap font-mono">${escapeHTML(p.periodos_reclusao)}</p></div>
                        <div><strong>Área de Atuação Geográfica:</strong><p class="whitespace-pre-wrap font-mono">${escapeHTML(p.atuacao_geografica)}</p></div>
                        <div><strong>Redes Sociais:</strong><p class="whitespace-pre-wrap font-mono">${escapeHTML(p.redes_sociais)}</p></div>
                    </div>
                 </div>`;

                // Seção de Afiliações
                let afiliacoesHtml = '<div class="mt-4 pt-4 border-t"><h4 class="font-semibold">Afiliações:</h4>';
                if (afiliacoesData && afiliacoesData.length > 0) {
                    const orgsNomes = afiliacoesData.map(orgId => {
                        const org = todasOrganizacoes.find(o => o.id == orgId);
                        return org ? `<li>${escapeHTML(org.nome)}</li>` : '';
                    }).join('');
                    afiliacoesHtml += `<ul class="list-disc pl-5 text-sm">${orgsNomes}</ul>`;
                } else {
                    afiliacoesHtml += '<p class="text-sm text-gray-500">Nenhuma.</p>';
                }
                afiliacoesHtml += '</div>';

                // Seção de Tatuagens
                let tattoosHtml = '<div class="mt-4 pt-4 border-t"><h4 class="font-semibold">Tatuagens:</h4>';
                if (tatuagensData && tatuagensData.length > 0) {
                    tattoosHtml += '<ul class="list-disc pl-5 text-sm">';
                    tatuagensData.forEach(t => {
                        tattoosHtml += `<li><strong>${escapeHTML(t.local_corpo)}:</strong> ${escapeHTML(t.descricao)}</li>`;
                    });
                    tattoosHtml += '</ul>';
                } else {
                    tattoosHtml += '<p class="text-sm text-gray-500">Nenhuma.</p>';
                }
                tattoosHtml += '</div>';

                detailsContent.innerHTML = html + afiliacoesHtml + tattoosHtml;
            } else {
                detailsContent.innerHTML = `<p class="text-red-500">Erro ao carregar detalhes.</p>`;
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            carregarPessoas();
            popularOrganizacoes();
            addForm.addEventListener('submit', adicionarPessoa);
            editForm.addEventListener('submit', salvarAlteracoes);
            confirmDeleteBtn.addEventListener('click', excluirPessoa);
            document.getElementById('btn-add-tattoo').addEventListener('click', adicionarTatuagemAdd);
            document.getElementById('btn-edit-add-tattoo').addEventListener('click', adicionarTatuagemEdit);
        });
    </script>
</body>

</html>