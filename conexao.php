<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexao = new mysqli("localhost", "root", "", "teste");
    $conexao->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    exit("Erro interno ao conectar ao banco de dados.");
}

function escapar(?string $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}
?>
