<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Music Owner</title>
</head>

<body>
    <div class="imagem">
        <?php
            session_start();

            require_once "model/GeneroCantor.php";
            require_once "configs/utils.php";
            require_once "configs/methods.php";

            $cantores = GeneroCantor::listarCantoresGenero("pop");

            if (!parametrosValidos($_SESSION, ["i"])) {
                $_SESSION["i"] = 0; 
                $_SESSION["nAcertos"] = 0;

                $i = $_SESSION["i"];

                $imgCantor = $cantores[$i]["img"];
        
                echo "<img src='$imgCantor'><br><br>";
            }

            if(isMetodo("POST")){
                $_SESSION["i"]++;

                $i = $_SESSION["i"];

                $quantidade = $_SESSION["nAcertos"];

                $nomeCantor_usuario = ucwords($_POST["nomeCantor"]);

                $nomeCantor = $cantores[$i-1]["nome"];

                if($nomeCantor == $nomeCantor_usuario){
                    $_SESSION["nAcertos"]++;
                    $quantidade = $_SESSION["nAcertos"];
                }

                if($i < count($cantores)){
                    $imgCantor = $cantores[$i]["img"];
                    echo "<img src='$imgCantor'><br><br>";
                } else {
                    echo "<p>Não há mais cantores para exibir.</p>";
                    echo "<p>Números de acertos: $quantidade</p>";
                    unset($_SESSION["i"]);
                }
            }
        ?>
    </div>

    <form method="POST">
        <input type=text name="nomeCantor"><br><br>
        <button type="submit">Próximo</button>
    </form>
</body>

</html>