<?php
include("conexao.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit("ID invalido.");
}

try {
    $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conexao->close();

    header("Location: index.php");
    exit;
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    echo "Erro ao excluir o usuario.";
}
?>
