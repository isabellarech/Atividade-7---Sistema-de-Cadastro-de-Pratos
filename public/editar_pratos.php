<?php

include "../infra/conexao.php";

$id_prato = $_GET["id_prato"];

$sql = "SELECT * FROM pratos WHERE id_prato = ?";

$consulta = $conexao->prepare($sql);
$consulta->bind_param("i", $id_prato);
$consulta->execute();

$resultado = $consulta->get_result();
$prato = $resultado->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Pratos</title>
    <link rel="stylesheet" href="style/styles.css">
</head>

<body>
    <header>
        <h1>CRUD - Pratos</h1>
    </header>
    <main>
        <h2>Editando o prato <?php echo $prato["nome_prato"]?>!</h2>
        <form action="atualizar_pratos.php" method="POST">
            <input type="hidden" name="id_prato" value="<?php echo $prato["id_prato"]?>">

            <label for="nome_prato">Nome:</label>
            <input type="text" name="nome_prato" value="<?php echo $prato["nome_prato"]?>">
            <br>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" value="<?php echo $prato["descricao"]?>">
            <br>
            <label for="preco">Preço:</label>
            <input type="number" name="preco" step="0.01" value="<?php echo $prato["preco"]?>">
            <br>
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" value="<?php echo $prato["categoria"]?>">
            <br>
            <button type="submit">Atualizar</button>
        </form>

    </main>
    <footer>

    </footer>


</body>

</html>