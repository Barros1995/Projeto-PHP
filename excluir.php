<?php
include("conexao.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null || $id <= 0) {
    http_response_code(400);
    exit("ID inválido.");
}

// Se for POST, delete e redireciona
if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
        echo "Erro ao excluir o usuário.";
    }
}

// Se for GET, busca os dados para confirmação
try {
    $stmt = $conexao->prepare("SELECT id, nome FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();
    $stmt->close();
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    exit("Erro ao buscar o usuário.");
}

if (!$usuario) {
    http_response_code(404);
    echo "Usuário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .confirmacao {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .confirmacao p {
            color: #856404;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .usuario-nome-destaque {
            font-weight: bold;
            color: #d39e00;
            font-size: 18px;
        }
        .botoes-confirmacao {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        .btn-cancelar {
            padding: 10px 25px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn-cancelar:hover {
            background: #5a6268;
        }
        .btn-confirmar {
            padding: 10px 25px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-confirmar:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Excluir Usuário</h1>
        
        <div class="confirmacao">
            <p>⚠ Tem certeza que deseja excluir este usuário?</p>
            <p class="usuario-nome-destaque"><?php echo escapar($usuario["nome"]); ?></p>
            <p>Esta ação não pode ser desfeita.</p>
        </div>

        <form action="excluir.php?id=<?php echo $id; ?>" method="POST">
            <div class="botoes-confirmacao">
                <a href="index.php" class="btn-cancelar">← Cancelar</a>
                <button type="submit" class="btn-confirmar">✓ Confirmar Exclusão</button>
            </div>
        </form>
    </div>
</body>
</html>
