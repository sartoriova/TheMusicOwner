<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Music Owner</title>
    <link rel="stylesheet" href="css/cadastro.css">
</head>

<body>
    
    <h3>Cadastrando Usuario:</h3>

    <form method="POST">
        <p>Nome:</p>
            <input type="text" name="nome" required>
        <p>E-mail:</p>
            <input type="email" name="email" required>
        <p>Senha:</p>
            <input type="password" name="senha" required><br><br>
        <button>Cadastrar</button>
    </form><br>

    <!-- <a href="index.php">Fazer login</a><br><br> -->

    <?php
        session_start();

        require_once "model/Usuario.php";
        require_once "configs/utils.php";
        require_once "configs/methods.php";
        require_once "verificaLogin.php";
       
        if(isMetodo("POST")){
            if(parametrosValidos($_POST, ["nome", "email", "senha"])){
                $nome = $_POST["nome"]; 
                $email = $_POST["email"];
                $senha = $_POST["senha"];

                $existeEmail = Usuario::existeEmail($email);

                if($existeEmail){
                    echo "<p>Este e-mail já está sendo usado por outro usuário!</p>";
                }else{
                    $resultado = Usuario::cadastrar($nome, $email, $senha);
                        
                    if($resultado) {
                        // echo "<p>O usuário $nome foi cadastrado com sucesso!</p>";
                        header("Location: index.php");
                    } else{
                        echo "<p>Houve erro no cadastro do $nome!</p>";
                    }
                }
            }
        } 
    ?> 

</body>

</html>