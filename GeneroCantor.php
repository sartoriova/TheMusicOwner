<?php
    require_once "configs/BancoDados.php";

    Class GeneroCantor{

        public static function listarCantoresGenero($tipoGenero){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select c.* from generomusical_cantor as gc, cantor as c where gc.nomeCantor = c.nome and gc.tipoGenero = ?
                ");
                $sql->execute([$tipoGenero]);
    
                return $sql->fetchAll();
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

    }
?>
