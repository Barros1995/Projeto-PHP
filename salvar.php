<?php
include("conexao.php");

$nome = trim($_POST["nome"] ?? "");

if ($nome === "") {
    http_response_code(400);
    echo "Nome obrigatorio.";
    exit;
}

try {
    $stmt = $conexao->prepare("INSERT INTO usuarios (nome) VALUES (?)");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->close();
    $conexao->close();

    header("Location: index.php");
    exit;
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo "Erro ao salvar o usuario.";
}
?>
