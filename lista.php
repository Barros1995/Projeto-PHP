<?php
include_once("conexao.php");

function obterUsuarios(mysqli $conexao): array
{
    $usuarios = [];

    try {
        $resultado = $conexao->query("SELECT id, nome FROM usuarios ORDER BY id DESC");

        while ($row = $resultado->fetch_assoc()) {
            $usuarios[] = [
                "id" => (int) $row["id"],
                "nome" => $row["nome"],
            ];
        }

        $resultado->free();
    } catch (mysqli_sql_exception $e) {
        return [];
    }

    return $usuarios;
}

function renderUsuarios(array $usuarios): void
{
    if (count($usuarios) === 0) {
        echo "<p class='lista-vazia'>Nenhum usuário cadastrado.</p>";
        return;
    }

    foreach ($usuarios as $usuario) {
        $id = $usuario["id"];
        $nome = escapar($usuario["nome"]);

        echo "<div class='usuario-item'>";
        echo "    <span class='usuario-nome'>{$nome}</span>";
        echo "    <div class='usuario-acoes'>";
        echo "        <a href='editar.php?id={$id}'>✎ Editar</a>";
        echo "        <a href='excluir.php?id={$id}' data-confirm='Tem certeza que deseja excluir este usuário?'>✕ Excluir</a>";
        echo "    </div>";
        echo "</div>";
    }
}
?>
