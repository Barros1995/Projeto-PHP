<!DOCTYPE html>
<html>
<head>
    <title>Teste PHP</title>
</head>
<body>
<h1>Digite seu nome</h1>

<form action="salvar.php" method="POST">
    <input type="text" name="nome">
    <button type="submit">Enviar</button>
</form>

<h2>Lista:</h2>
<?php include("lista.php"); ?>

</body>
</html>