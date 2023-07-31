<!DOCTYPE html>
<html>
<head>
    <title>Configuração do Perfil</title>
</head>
<body>
    <h1>Configuração do Perfil</h1>
    <form action="configuracao.php" method="post" enctype="multipart/form-data">
        <h2>Foto de Perfil:</h2>
        <img src="img/<?php echo $fotoPerfil; ?>" alt="Foto de Perfil">
        <label for="foto_perfil">Atualizar Foto de Perfil:</label>
        <input type="file" name="foto_perfil">
        <h2>Configurações do Perfil:</h2>
        <label for="novo_nome">Nome:</label>
        <input type="text" name="novo_nome" value="<?php echo $nome; ?>">
        <label for="nova_biografia">Biografia:</label>
        <textarea name="nova_biografia"><?php echo $biografia; ?></textarea>
        <input type="submit" value="Salvar Alterações">
    </form>
</body>
</html>
