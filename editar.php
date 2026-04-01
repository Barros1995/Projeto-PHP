<?php
include("conexao.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit("ID invalido.");
}

try {
    $stmt = $conexao->prepare("SELECT id, nome FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $stmt->close();
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    exit("Erro ao buscar o usuario.");
}

if (!$usuario) {
    http_response_code(404);
    echo "Usuario nao encontrado.";
    exit;
}

$nomeInput = $usuario["nome"];

if (isset($_GET["nome"])) {
    $nomeInput = $_GET["nome"];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .btn-voltar {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        .btn-voltar:hover {
            background: #5a6268;
        }
        .erro-msg {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-voltar">← Voltar</a>
        <h1>Editar Usuário</h1>

        <?php if (isset($_GET["erro"])): ?>
            <div class="erro-msg">⚠ Nome é obrigatório.</div>
        <?php endif; ?>

        <form action="atualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo escapar((string) $usuario["id"]); ?>">
            <div class="form-group">
                <input type="text" name="nome" value="<?php echo escapar($nomeInput); ?>" placeholder="Nome do usuário" required>
                <button type="submit">Atualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
