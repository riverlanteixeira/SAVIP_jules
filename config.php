<?php
// ARQUIVO: config.php
// Descrição: Configurações de conexão com o banco de dados.
// Crie este arquivo para centralizar os dados de acesso.

define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Usuário padrão do WAMP
define('DB_PASS', '');     // Senha padrão do WAMP é vazia. MUDAR EM PRODUÇÃO!
define('DB_NAME', 'savip_db'); // O nome do banco de dados que você criou

// Tenta criar uma conexão com o banco de dados
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verifica se a conexão falhou
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Define o charset para UTF-8 para evitar problemas com acentuação
$conn->set_charset("utf8mb4");

?>