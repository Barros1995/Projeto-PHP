<?php
include("conexao.php");

try {
    $resultado = $conexao->query("SELECT id, nome FROM usuarios ORDER BY id DESC");

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $id = (int) $row["id"];
            $nome = escapar($row["nome"]);

            echo "<div class='usuario-item'>";
            echo "    <span class='usuario-nome'>{$nome}</span>";
            echo "    <div class='usuario-acoes'>";
            echo "        <a href='editar.php?id={$id}'>✎ Editar</a>";
            echo "        <a href='excluir.php?id={$id}'>✕ Excluir</a>";
            echo "    </div>";
            echo "</div>";
        }
    } else {
        echo "<p class='lista-vazia'>Nenhum usuário cadastrado.</p>";
    }

    $resultado->free();
    $conexao->close();
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo "<p class='lista-vazia'>Erro ao listar os usuários.</p>";
}
?>
