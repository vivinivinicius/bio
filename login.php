<?php
// Início da sessão
session_start();




// Habilitar exibição de erros durante o desenvolvimento
$exibirErros = true;
if ($exibirErros) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

// Verifica se o usuário já está logado
if (isset($_SESSION['usuario_id'])) {
    header("Location: configuracao.php"); // Redireciona para a tela de configuração após o login
    exit();
}

// Processamento do formulário de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coloque aqui a lógica de autenticação do usuário
    // Verifique as credenciais fornecidas pelo usuário e, se forem válidas, inicie a sessão e redirecione para a página de configuração
    // Exemplo simples para fins de demonstração:
    $usuario_id = 1; // Simulando o ID do usuário autenticado após a verificação das credenciais
    $_SESSION['usuario_id'] = $usuario_id;
    header("Location: configuracao.php"); // Redireciona para a tela de configuração após o login
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
