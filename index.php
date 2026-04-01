<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciador de Usuários</h1>

        <form action="salvar.php" method="POST">
            <div class="form-group">
                <input type="text" name="nome" placeholder="Digite o nome do usuário" required>
                <button type="submit">Adicionar</button>
            </div>
        </form>

        <h2>Usuários Cadastrados</h2>
        <?php include("lista.php"); ?>
    </div>
</body>
</html>