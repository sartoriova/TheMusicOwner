<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Music Owner</title>
</head>

<body>

    <form method="POST">
        <h3 class="text-center">Cadastrando Usuario:</h3>
        <p>Nome:</p><input type="text" name="nome" required>
        <p>E-mail:</p><input type="email" name="email" required>
        <p>Senha:</p><input type="password" name="senha" required>
        <br><br>
        <button class="btn btn-primary">Cadastrar</button>
    </form><br>

    <a href="index.php">Fazer login</a><br><br>

    <?php
        require_once "model/Usuario.php";
        require_once "configs/utils.php";
        require_once "configs/methods.php";
       
        if(isMetodo("POST")){
            if(parametrosValidos($_POST, ["nome", "email", "senha"])){
                $nome = $_POST["nome"]; 
                $email = $_POST["email"];
                $senha = $_POST["senha"];
    
                $resultado = Usuario::cadastrar($nome, $email, $senha);
                        
                if($resultado) {
                    echo "<p>O usuário $nome foi cadastrado com sucesso!";
                } else{
                    echo "<p>Houve erro no cadastro do $nome";
                }
            }
        }
    ?>

</body>

</html>
