<?php
include("conexao.php");

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nome = trim($_POST["nome"] ?? "");

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit("ID invalido.");
}

if ($nome === "") {
    header("Location: editar.php?id=$id&erro=1&nome=" . urlencode($nome));
    exit;
}

try {
    $stmt = $conexao->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
    $stmt->bind_param("si", $nome, $id);
    $stmt->execute();
    $stmt->close();
    $conexao->close();

    header("Location: index.php");
    exit;
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo "Erro ao atualizar o usuario.";
}
?>
