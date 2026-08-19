<?php

include "../infra/conexao.php";

$nome = $_POST["nome_"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];

$sql = "INSERT INTO livros (titulo,autor,ano) VALUES ('$titulo','$autor','$ano')";

mysqli_query($conexao, $sql);

header("Location: ../index.php");
?>