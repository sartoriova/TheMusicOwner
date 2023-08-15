<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Music Owner</title>
</head>

<body>

    <h3>Logando Usuario:</h3>

    <form method="POST">
        <p>E-mail:</p>
            <input type="email" name="email" required>
        <p>Senha:</p>
            <input type="password" name="senha" required><br><br>
        <button class="btn btn-primary">Entrar</button>
    </form><br>

    <a href="cadastro.php">Cadastre-se</a><br><br>

    <?php
        session_start();

        require_once "model/Usuario.php";
        require_once "configs/utils.php";
        require_once "verificaLogin.php";
       
        if(isMetodo("POST")){
            if(parametrosValidos($_POST, ["email", "senha"])){
                $email = $_POST["email"];
                $senha = $_POST["senha"];
    
                $resultado = Usuario::fazerLogin($email, $senha);
    
                if(!$resultado) {
                    echo "<p>E-mail ou senha incorretos!</p>";
                }else{
                    $_SESSION["idUsuario"] = $resultado;
                    // echo "<p>Seja bem-vindo(a)!</p>";
                    header("Location: home.php");
                }
                
            }
        }
    ?>

</body>

</html>