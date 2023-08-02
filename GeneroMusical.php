<?php
    require_once "configs/BancoDados.php";

    Class GeneroMusical{

        public static function alterar($tipo, $classificacao){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select * from generoMusical where tipo = ?
                ");
                $sql->execute([$tipo]);

                $resultado = $sql->fetchAll();

                $sql1 = $conexao->prepare("
                    update generoMusical set classificacao = ? where tipo = ?
                ");
                $sql1->execute([$classificacao, $tipo]);

                if($sql1->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }
?>
