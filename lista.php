<?php
include("conexao.php");

try {
    $resultado = $conexao->query("SELECT id, nome FROM usuarios ORDER BY id DESC");

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $id = (int) $row["id"];
            $nome = escapar($row["nome"]);

            echo "<p>{$nome} <a href='editar.php?id={$id}'>editar</a> <a href='excluir.php?id={$id}'>excluir</a></p>";
        }
    } else {
        echo "Nenhum usuario cadastrado.";
    }

    $resultado->free();
    $conexao->close();
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo "Erro ao listar os usuarios.";
}
?>
