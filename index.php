<?php

include 'infra/conexao.php';

$sql = "SELECT * FROM pratos";
$resultado = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario'] ?? null;

    if ($usuario_id) {
        $sql = "SELECT * FROM pratos WHERE id_usuario = $usuario_id";
    } else {
        $sql = "SELECT * FROM pratos";
    }

    $resultado = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Pratos</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>

    <main>
        <h1>Gerenciador de Pratos</h1>

        <a href="public/cad_prato.php">Cadastrar Prato</a>
        <a href="public/cad_user.php">Cadastrar Usuário</a>

        <br><br>

        <form method="POST">
            <label for="usuario">Filtragem por Usuário</label>

            <select id="usuario" name="usuario">
                <option value="">Todos</option>

                <?php
                $sqlUsuarios = "SELECT * FROM usuarios";
                $resultadoUsuarios = mysqli_query($conn, $sqlUsuarios);

                while ($usuario = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<option value='{$usuario['id_usuario']}'>{$usuario['nome_usuario']}</option>";
                }
                ?>

            </select>

            <button type="submit">Filtrar</button>

            <br><br>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>ID do Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                <?php
                while ($prato = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>{$prato['nome_prato']}</td>";
                    echo "<td>{$prato['descricao']}</td>";
                    echo "<td>R$ {$prato['preco']}</td>";
                    echo "<td>{$prato['categoria']}</td>";
                    echo "<td>{$prato['id_usuario']}</td>";

                    echo "<td>
                            <a href='public/editar_prato.php?id={$prato['id_prato']}'>Editar</a> |
                            <a href='public/excluir_prato.php?id={$prato['id_prato']}'>Excluir</a>
                          </td>";

                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>

    </main>

</body>

</html>