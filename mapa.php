<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVIP - Mapeamento Geográfico</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <style>
        /* O contêiner do mapa DEVE ter uma altura definida */
        #map { height: 75vh; }
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
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Adiciona um item de menu ativo para o Mapa
            const nav = document.querySelector('nav div div:last-child');
            const mapLink = document.createElement('a');
            mapLink.href = 'mapa.php';
            mapLink.className = 'px-3 py-2 rounded-md text-sm font-medium bg-gray-900'; // Ativo
            mapLink.textContent = 'Mapa';
            if (nav) nav.appendChild(mapLink); // Verifica se nav existe
        });
    </script>


    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Mapeamento Geográfico</h1>
            <p class="text-gray-500 mt-1">Visualize os locais de interesse cadastrados no mapa interativo.</p>
        </header>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div id="map"></div>
        </div>
    </div>

    <script>
        const API_URL = 'api.php';

        // 1. Inicialização do Mapa
        // As coordenadas [-14.235, -51.925] centralizam o mapa no Brasil.
        const map = L.map('map').setView([-14.235, -51.925], 5);

        // 2. Camada de Mapa (Tiles)
        // Usamos o OpenStreetMap, que é um serviço gratuito e aberto.
        // A atribuição é obrigatória por questões de direitos de uso.
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // 3. Função para carregar e exibir os marcadores
        async function carregarMarcadores() {
            try {
                // Chama a nossa API para buscar todos os locais
                const response = await fetch(`${API_URL}?action=getLocais`);
                const locais = await response.json();

                if (locais.length > 0) {
                    locais.forEach(l => {
                        // Validação: Só adiciona o marcador se houver latitude e longitude
                        if (l.latitude && l.longitude) {
                            const lat = parseFloat(l.latitude);
                            const lon = parseFloat(l.longitude);
                            
                            // Cria o conteúdo do popup que aparecerá ao clicar no marcador, com sanitização
                            const popupContent = `
                                <div class="font-sans">
                                    <h3 class="font-bold text-base mb-1">${escapeHTML(l.descricao) || 'Local sem descrição'}</h3>
                                    <p class="text-sm">${escapeHTML(l.rua) || ''}, ${escapeHTML(l.numero) || 'S/N'}</p>
                                    <p class="text-sm">${escapeHTML(l.municipio) || ''} - ${escapeHTML(l.uf) || ''}</p>
                                    <a href="locais.php" class="text-blue-600 hover:underline text-xs mt-2 block">Ver/Editar Local</a>
                                </div>
                            `;

                            // Cria o marcador e o adiciona ao mapa
                            L.marker([lat, lon]).addTo(map)
                                .bindPopup(popupContent);
                        }
                    });
                }

            } catch (error) {
                console.error("Erro ao carregar marcadores:", error);
                alert("Não foi possível carregar os locais no mapa.");
            }
        }

        // 4. Carrega os marcadores quando a página é aberta
        document.addEventListener('DOMContentLoaded', () => {
            carregarMarcadores();
        });

        function escapeHTML(str) {
            if (str === null || typeof str === 'undefined') return '';
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(String(str)));
            return div.innerHTML;
        }
    </script>

</body>
</html>