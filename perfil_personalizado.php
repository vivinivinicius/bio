<?php
// Inclua o arquivo de conexão com o banco de dados
require_once "conexao.php";

// Inicie a sessão
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Recupere os dados do usuário a partir da sessão
$usuario = $_SESSION['usuario'];
$usuario_id = $usuario['usuario_id'];
$nome = $usuario['nome'];
$email = $usuario['email'];

// Resto do código de perfil_personalizado...

// Recupere a URL personalizada do perfil a partir da URL
$urlPersonalizada = $_SERVER['REQUEST_URI'];
$urlPersonalizada = str_replace("/bio/", "", $urlPersonalizada); // Remove "/bio/" do início da URL

$query = "SELECT * FROM usuarios WHERE url_perfil = '$urlPersonalizada'";
$result = $conn->query($query);

// Verifique se o usuário com a URL personalizada existe no banco de dados
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    // Verifique se o perfil visualizado é do próprio usuário logado
    if ($row['usuario_id'] === $usuario_id) {
        // O perfil visualizado é do próprio usuário logado, portanto use os dados da sessão
        $biografia = $usuario['biografia'];
        $fotoPerfil = $usuario['foto_perfil'];
        $imagemFundo = isset($usuario['imagem_fundo']) ? $usuario['imagem_fundo'] : 'default.jpg';
        $instagram = $usuario['instagram'];
        $discord = $usuario['discord'];
        $twitter = $usuario['twitter'];
        $lastfm = $usuario['lastfm'];
        $steam = $usuario['steam'];
        $leagueoflegends = $usuario['leagueoflegends'];
    } else {
        // O perfil visualizado é de outro usuário, use os dados do banco de dados
        $biografia = $row['bio'];
        $fotoPerfil = $row['foto_perfil'];
        $imagemFundo = isset($row['imagem_fundo']) ? $row['imagem_fundo'] : 'default.jpg';
        $instagram = $row['instagram'];
        $discord = $row['discord'];
        $twitter = $row['twitter'];
        $lastfm = $row['lastfm'];
        $steam = $row['steam'];
        $leagueoflegends = $row['leagueoflegends'];
    }
} else {
    // Caso não haja usuário com a URL personalizada, redirecione para uma página de erro ou perfil padrão
    header("Location: perfil_nao_encontrado.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Perfil Personalizado</title>
    <link rel="stylesheet" href="style_global.css">
    <link rel="stylesheet" href="style_personalizado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .profile-background {
            width: 100%;
            min-height: 500px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 5px;
            margin-top: 20px;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            background-image: url('background/<?php echo $imagemFundo; ?>');
        }
    </style>
</head>

<body>
    <h1>Perfil de <?php echo $nome; ?></h1>
    <div class="profile-image">
        <img src="img/<?php echo $fotoPerfil; ?>" alt="Foto de Perfil">
    </div>
    <div class="profile-background">
        <h2>Biografia:</h2>
        <p><?php echo $biografia; ?></p>

        <!-- Exibir redes sociais com ícones compactos -->
        <div class="social-icons">
            <?php if (!empty($instagram)) : ?>
                <a href="<?php echo $instagram; ?>" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
            <?php endif; ?>

            <?php if (!empty($discord)) : ?>
                <a href="<?php echo $discord; ?>" target="_blank" title="Discord"><i class="fab fa-discord"></i></a>
            <?php endif; ?>

            <?php if (!empty($twitter)) : ?>
                <a href="<?php echo $twitter; ?>" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a>
            <?php endif; ?>

            <?php if (!empty($lastfm)) : ?>
                <a href="<?php echo $lastfm; ?>" target="_blank" title="Last.fm"><i class="fab fa-lastfm"></i></a>
            <?php endif; ?>

            <?php if (!empty($steam)) : ?>
                <a href="<?php echo $steam; ?>" target="_blank" title="Steam"><i class="fab fa-steam"></i></a>
            <?php endif; ?>

            <?php if (!empty($leagueoflegends)) : ?>
                <a href="<?php echo $leagueoflegends; ?>" target="_blank" title="League of Legends"><i class="fab fa-twitch"></i></a>
            <?php endif; ?>
        </div>

        <!-- Aqui você pode adicionar mais informações do perfil personalizado -->
        <!-- Por exemplo, adicionar outras informações do usuário específicas do perfil personalizado -->
    </div>
</body>

</html>
