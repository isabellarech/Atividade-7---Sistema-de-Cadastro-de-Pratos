<?php

include 'infra/conexao.php';

$sql = "SELECT pratos.*, usuarios.nome_usuario
        FROM pratos
        INNER JOIN usuarios
        ON pratos.id_usuario = usuarios.id_usuario";

$consulta = $conexao->prepare($sql);
$consulta->execute();
$pratos = $consulta->get_result();

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

    <header>
        <h1>CRUD - Pratos</h1>
    </header>

    <main>
        <h2>Adicione um novo usuário:</h2>

        <form action="public/cadastrar_usuario.php" method="POST">
            <label for="nome_usuario">Nome:</label>
            <input type="text" name="nome_usuario">
            <br>
            <label for="email">E-mail:</label>
            <input type="email" name="email">
            <br>
            <button type="submit">Cadastrar Usuário</button>
        </form>

        <h2>Gerenciador de Pratos:</h2>

        <form action="public/cadastrar_prato.php" method="POST">
            <label for="nome_prato">Nome:</label>
            <input type="text" name="nome_prato">
            <br>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao">
            <br>
            <label for="preco">Preço:</label>
            <input type="number" name="preco" step="0.01">
            <br>
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria">
            <br>
            <label for="id_usuario">Usuário:</label>
            <select name="id_usuario">

                <?php

                $sqlUsuarios = "SELECT * FROM usuarios";
                $consultaUsuarios = $conexao->prepare($sqlUsuarios);
                $consultaUsuarios->execute();
                $usuarios = $consultaUsuarios->get_result();

                while ($usuario = mysqli_fetch_assoc($usuarios)) {
                    echo "<option value='{$usuario["id_usuario"]}'>{$usuario["nome_usuario"]}</option>";
                }

                ?>

            </select>

            <br>

            <button type="submit">Cadastrar</button>

        </form>

        <div>

            <h2>Pratos Cadastrados</h2>

            <table>

                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>

                <?php while ($prato = mysqli_fetch_assoc($pratos)) { ?>

                    <tr>
                        <td><?php echo $prato["id_prato"] ?></td>
                        <td><?php echo $prato["nome_prato"] ?></td>
                        <td><?php echo $prato["descricao"] ?></td>
                        <td><?php echo $prato["preco"] ?></td>
                        <td><?php echo $prato["categoria"] ?></td>
                        <td><?php echo $prato["nome_usuario"] ?></td>

                        <td>
                            <a href="public/editar_prato.php?id_prato=<?php echo $prato["id_prato"] ?>">
                                Editar
                            </a>
                            <a href="public/excluir_prato.php?id_prato=<?php echo $prato["id_prato"] ?>">
                                Excluir
                            </a>
                        </td>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </main>
    
</body>
</html>