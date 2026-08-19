<?php

include "../infra/conexao.php";

$nome_usuario = $_POST["nome_usuario"];
$email = $_POST["email"];

$sql = "INSERT INTO usuarios (nome_usuario,email) VALUES (?, ?)";

$consulta = $conexao->prepare($sql);

$consulta->bind_param("ss", $nome_usuario, $email);

$consulta->execute();

header("Location: ../index.php");
?>