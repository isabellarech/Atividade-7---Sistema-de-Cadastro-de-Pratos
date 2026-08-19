<?php

include "../infra/conexao.php";

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$categoria = $_POST["categoria"];
$id_usuario = $_POST["id_usuario"];

$sql = "INSERT INTO pratos (nome,descricao,preco,categoria,id_usuario) VALUES (?, ?, ?, ?, ?)";

$consulta = $conexao->prepare($sql);

$consulta->bind_param("ssdsi", $nome, $descricao, $preco, $categoria, $id_usuario);

$consulta->execute();

header("Location: ../index.php");
?>