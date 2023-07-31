<?php
// Defina essa variável para true durante o desenvolvimento
$exibirErros = true;

if ($exibirErros) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Configuração da conexão com o banco de dados
$hostname = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$database = "bio"; // Nome do banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli($hostname, $username, $password, $database);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
