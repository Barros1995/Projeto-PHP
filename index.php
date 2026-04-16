<?php
$pageTitle = "Gerenciador de Usuários";
include("header.php");
include("lista.php");
$usuarios = obterUsuarios($conexao);
?>
        <h1>Gerenciador de Usuários</h1>

        <form action="salvar.php" method="POST" data-confirm="Deseja realmente adicionar este usuário?">
            <div class="form-group">
                <input type="text" name="nome" placeholder="Digite o nome do usuário" required>
                <button type="submit">Adicionar</button>
            </div>
        </form>

        <h2>Usuários Cadastrados</h2>
        <?php renderUsuarios($usuarios); ?>
<?php include("footer.php"); ?>