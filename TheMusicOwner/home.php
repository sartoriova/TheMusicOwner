<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Music Owner</title>
</head>
<body>
    <form method="POST">
        <button type="submit">POP</button>
    </form><br>

    <a href="logout.php">Logout</a><br>

    <?php
        require_once "model/Usuario.php";
        require_once "configs/utils.php";

        if(isMetodo("POST")){
            header("Location: partida.php");
        }
    ?>
</body>
</html>