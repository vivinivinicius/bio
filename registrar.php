<?php
// Inclua o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Verifique se o e-mail já está em uso
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        echo "Este e-mail já está em uso. Tente outro.";
    } else {
        // Criptografe a senha antes de inserir no banco de dados
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Insira os dados na tabela de usuários
        $insere = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
        
        if ($conn->query($insere) === TRUE) {
            echo "Registro realizado com sucesso!";
        } else {
            echo "Erro ao registrar o usuário: " . $conn->error;
        }
    }
}
?>
