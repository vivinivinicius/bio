<?php
// Inicie a sessão
session_start();

// Faça o login do usuário e defina o ID de sessão
$_SESSION['usuario_id'] = $id_do_usuario;

// Regenerar o ID de sessão para garantir que seja único
session_regenerate_id();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Inclua o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Recupere as informações do usuário a partir do ID da sessão
$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT * FROM usuarios WHERE id = $usuario_id";
$result = $conn->query($query);

// Verifique se o usuário existe no banco de dados
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $email = $row['email'];
    $biografia = $row['bio'];
    $fotoPerfil = $row['foto_perfil'];
} else {
    // Caso ocorra algum erro, redirecione para a página de login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil do Usuário</title>
 <link rel="stylesheet" href="style_global.css">
    <link rel="stylesheet" href="style_perfil.css">
</head>
<body>
    <h1>Perfil do Usuário</h1>
    <h2>Informações do Perfil:</h2>
    <p>Nome: <?php echo $nome; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <h2>Foto de Perfil:</h2>
    <img src="img/<?php echo $fotoPerfil; ?>" alt="Foto de Perfil">
    <h2>Biografia:</h2>
    <p><?php echo $biografia; ?></p>

    <nav>
        <a href="configuracao.php">Configurar Perfil</a>
    </nav>
</body>
</html>
