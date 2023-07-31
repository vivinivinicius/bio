<?php
// Inclua o arquivo de conexão com o banco de dados
require_once "conexao.php";

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
    $urlPerfil = $row['url_perfil'];
    $instagram = $row['instagram'];
    $discord = $row['discord'];
    $twitter = $row['twitter'];
    $lastfm = $row['lastfm'];
    $steam = $row['steam'];
    $leagueoflegends = $row['leagueoflegends'];
    $fotoFundo = $row['imagem_fundo']; // Caminho da imagem de fundo atual
    
} else {
    // Caso ocorra algum erro, redirecione para a página de login
    header("Location: login.php");
    exit();
}

// Resto do código de configuração do perfil...

// Atualização dos dados do perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Atualize o nome, a biografia e a URL do usuário
    $novoNome = $_POST['novo_nome'];
    $novaBiografia = $_POST['nova_biografia'];
    $novaURLPerfil = $_POST['nova_url_perfil'];
    $novoInstagram = $_POST['instagram'];
    $novoDiscord = $_POST['discord'];
    $novoTwitter = $_POST['twitter'];
    $novoLastfm = $_POST['lastfm'];
    $novoSteam = $_POST['steam'];
    $novoLeagueOfLegends = $_POST['leagueoflegends'];

    // Verifique se a URL personalizada é válida e única
    if (validarURLPersonalizada($novaURLPerfil)) {
        // Verifique se a URL foi alterada
        if ($novaURLPerfil !== $urlPerfil) {
            // Caso a URL tenha sido alterada, redirecione para a nova URL personalizada
            header("Location: $novaURLPerfil");
            exit();
        }

        // Atualize as informações do perfil no banco de dados
        $queryAtualizaPerfil = "UPDATE usuarios SET nome = '$novoNome', bio = '$novaBiografia', url_perfil = '$novaURLPerfil', instagram = '$novoInstagram', discord = '$novoDiscord', twitter = '$novoTwitter', lastfm = '$novoLastfm', steam = '$novoSteam', leagueoflegends = '$novoLeagueOfLegends' WHERE id = $usuario_id";
        $conn->query($queryAtualizaPerfil);
    } else {
        // Caso a URL não seja válida, redirecione com uma mensagem de erro na URL
        header("Location: configuracao.php?error=url_invalida");
        exit();
    }

    // Verifique se o usuário enviou uma imagem de fundo
    if ($_FILES['foto_fundo']['size'] > 0) {
        $fotoFundo = $_FILES['foto_fundo'];

        // Verifique se é uma imagem ou gif
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fotoFundo['type'], $allowedTypes)) {
            // Nomeie a imagem com um nome único para evitar conflitos
            $nomeFotoFundo = uniqid() . '_' . $fotoFundo['name'];

            // Mova a imagem para a pasta de imagens de fundo
            $caminhoFotoFundo = 'back/' . $nomeFotoFundo;
            move_uploaded_file($fotoFundo['tmp_name'], $caminhoFotoFundo);

            // Atualize a URL da imagem de fundo no banco de dados
            $queryAtualizaFotoFundo = "UPDATE usuarios SET imagem_fundo = '$caminhoFotoFundo' WHERE id = $usuario_id";
            $conn->query($queryAtualizaFotoFundo);
        }
    }
}
// Função para validar a URL personalizada
function validarURLPersonalizada($url) {
    // Implemente aqui a validação da URL personalizada
    // Por exemplo, você pode verificar se a URL é única no banco de dados
    // e se segue um formato específico, como não conter espaços, caracteres especiais, etc.
    // Retorne true se a URL for válida e única, ou false caso contrário.
    return true; // Substitua por sua lógica de validação
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Configuração do Perfil</title>
    <link rel="stylesheet" href="style_global.css">
    <link rel="stylesheet" href="style_configuracaao.css">
</head>
<body>
    <h1>Configuração do Perfil</h1>
    <h2>Informações do Perfil:</h2>
    <p>Nome: <?php echo $nome; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <h2>Foto de Perfil:</h2>
    <img src="img/<?php echo $fotoPerfil; ?>" alt="Foto de Perfil">
    <form action="configuracao.php" method="post" enctype="multipart/form-data">
        <label for="foto_perfil">Atualizar Foto de Perfil:</label>
        <input type="file" name="foto_perfil">
        <h2>Configurações do Perfil:</h2>
        <label for="novo_nome">Nome:</label>
        <input type="text" name="novo_nome" value="<?php echo $nome; ?>">
        <label for="nova_biografia">Biografia:</label>
        <textarea name="nova_biografia"><?php echo $biografia; ?></textarea>
        <!-- Novo campo para a URL personalizada -->
        <label for="nova_url_perfil">URL Personalizada:</label>
        <input type="text" name="nova_url_perfil" value="<?php echo $urlPerfil; ?>">
        
        <h2>Foto de Fundo:</h2>
<label for="foto_fundo">Atualizar Foto de Fundo:</label>
<input type="file" name="foto_fundo">
<?php if ($fotoFundo) : ?>
    <h3>Background atual:</h3>
    <img src="<?php echo $fotoFundo; ?>" alt="Background Atual" style="max-width: 300px;">
<?php endif; ?>
        <?php
        // Exibir mensagem de erro, se houver
        if (isset($_GET['error']) && $_GET['error'] === 'url_invalida') {
            echo '<p class="error-message">URL personalizada inválida ou já existente. Tente novamente.</p>';
        }
        ?>
        <!-- Campos para as redes sociais -->
        <h2>Redes Sociais:</h2>
        <label for="instagram">Instagram:</label>
        <input type="text" name="instagram" value="<?php echo $instagram; ?>">
        <label for="discord">Discord:</label>
        <input type="text" name="discord" value="<?php echo $discord; ?>">
        <label for="twitter">Twitter:</label>
        <input type="text" name="twitter" value="<?php echo $twitter; ?>">
        <label for="lastfm">Last.fm:</label>
        <input type="text" name="lastfm" value="<?php echo $lastfm; ?>">
        <label for="steam">Steam:</label>
        <input type="text" name="steam" value="<?php echo $steam; ?>">
        <label for="leagueoflegends">League of Legends:</label>
        <input type="text" name="leagueoflegends" value="<?php echo $leagueoflegends; ?>">
        <input type="submit" value="Salvar Conexões">
    </form>

    <nav>
    <?php if ($urlPerfil) : ?>
        <p><a href="<?php echo $urlPerfil; ?>">Ver Perfil Personalizado</a></p>
    <?php endif; ?>
    <a href="perfil.php">Voltar para o Perfil</a>
    </nav>
</body>
</html>
