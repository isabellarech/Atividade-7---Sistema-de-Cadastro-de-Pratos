<?php

include "../infra/conexao.php";

$id_prato = $_POST["id_prato"];
$nome_prato = $_POST["nome_prato"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];

$sql = "UPDATE pratos 
        SET nome_prato = ?, descricao = ?, preco = ?, categoria = ?
        WHERE id_prato = ?";

$consulta = $conexao->prepare($sql);
$consulta->bind_param("ssdsi", $nome_prato, $descricao, $preco, $categoria, $id_prato);
$consulta->execute();

header("Location: ../index.php");

?>