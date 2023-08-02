<?php
    require_once "configs/BancoDados.php";

    Class Partida{

        public static function tabelaPontuacao($idUser){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select tipoGenero, sum(pontuacao) from partida where idUser = ? group by tipoGenero;
                ");
                $sql->execute([$idUser]);
    
                return $sql->fetchAll();
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function cadastrar($idUser, $tipoGenero, $data, $hora, $pontuacao){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    insert into partida (idUser, tipoGenero, data, hora, pontuacao) values (?, ?, ?, ?, ?)
                ");
                $sql->execute([$idUser, $tipoGenero, $data, $hora, $pontuacao]);

                if($sql->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function existePartida($idUser, $tipoGenero, $data, $hora){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select count(*) from partida where idUser = ? and tipoGenero = ? and data = ? and hora = ?
                ");
                $sql->execute([$idUser, $tipoGenero, $data, $hora]);

                if($sql->fetchColumn() > 0){
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
