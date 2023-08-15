<?php
    if(parametrosValidos($_SESSION, ["idUsuario"])){
        echo "<p>Você já está logado!</p>";
        exit;
    }
?>