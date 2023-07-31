<?php
// Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Verifica se o usuário está logado
// (Você precisa implementar a verificação de sessão aqui, por exemplo, usando $_SESSION)
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o formulário foi enviado
if (isset($_POST['biografia'])) {
    $biografia = $_POST['biografia'];
    $usuario_id = $_SESSION['usuario_id'];

    // Atualiza a biografia no banco de dados
    $query = "UPDATE usuarios SET bio = '$biografia' WHERE id = '$usuario_id'";

    if ($conn->query($query) === TRUE) {
        echo "Biografia atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar a biografia: " . $conn->error;
    }
}
?>
