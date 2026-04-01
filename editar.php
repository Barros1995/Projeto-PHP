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
<html>
<head>
    <title>Editar usuario</title>
</head>
<body>
<h1>Editar usuario</h1>

<?php if (isset($_GET["erro"])): ?>
    <p style="color: red;">Nome obrigatorio.</p>
<?php endif; ?>

<form action="atualizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo escapar((string) $usuario["id"]); ?>">
    <input type="text" name="nome" value="<?php echo escapar($nomeInput); ?>">
    <button type="submit">Atualizar</button>
</form>

</body>
</html>
