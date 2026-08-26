<?php

include "../infra/conexao.php";

$id_prato = filter_input(INPUT_GET, "id_prato", FILTER_VALIDATE_INT);

if (!$id_prato) {
    header("Location: ../index.php");
    exit;
}

$sql = "DELETE FROM pratos WHERE id_prato = ?";

$consulta = $conexao->prepare($sql);

if (!$consulta) {
    die("Erro ao preparar exclusão: " . $conexao->error);
}

$consulta->bind_param("i", $id_prato);

if (!$consulta->execute()) {
    die("Erro ao excluir prato: " . $consulta->error);
}

$consulta->close();
$conexao->close();

header("Location: ../index.php");
exit;

?>