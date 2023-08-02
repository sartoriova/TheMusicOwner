<?php
    require_once "configs/BancoDados.php";

    Class Usuario{

        public static function existeEmailId($email, $id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select count(*) from usuario where email = ? and id not in (?)
                ");
                $sql->execute([$email, $id]);
    
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

        public static function existeEmail($email){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select count(*) from usuario where email = ?
                ");
                $sql->execute([$email]);
    
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

        public static function cadastrar($nome, $email, $senha, $nomeUser, $imgAvatar){
            try{
                $nomeUser = "LOVETHEMUSICOWNER"
                $imgAvatar = 
                $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    insert into usuario (nome, email, senha, nomeUser, imgAvatar) values (?, ?, ?, ?, ?)
                ");
                $sql->execute([$nome, $email, $senhaCriptografada, $nomeUser, $imgAvatar]);

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

        public static function fazerLogin($email, $senha){
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select * from usuario where email = ?
                ");
                $sql->execute([$email]);

                $resultado = $sql->fetchAll();

                if($resultado == []){
                    return false;
                }else{
                    if(password_verify($senha, $resultado[0]["senha"])){
                        return $resultado[0]["id"];
                    }else{
                        return false;
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function existeId($id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select count(*) from usuario where id = ?
                ");
                $sql->execute([$id]);

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

        public static function listarUm($id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select nome, email, nomeUser from usuario where id = ?
                ");
                $sql->execute([$id]);

                return $sql->fetchAll();
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function alterar($id, $nome, $email, $senhaAtual, $senhaNova, $nomeUser, $imgAvatar){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("
                    select * from usuario where id = ?
                ");
                $sql->execute([$id]);

                $resultado = $sql->fetchAll();

                if(password_verify($senhaAtual, $resultado[0]["Senha"])){
                    $senhaCriptografada = password_hash($senhaNova, PASSWORD_BCRYPT);

                    $sql1 = $conexao->prepare("
                        update usuario set nome = ?, email = ?, nomeUser = ?, imgAvatar = ? where id = ?
                    ");
                    $sql1->execute([$nome, $email, $senhaCriptografada, $nomeUser, $imgAvatar, $id]);

                    if($sql1->rowCount() > 0){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function deletar($id){
            try{
                $conexao = Conexao::getConexao();

                $sql = $conexao->prepare("
                    delete from partida where iduser = ?
                ");
                $sql1 = $conexao->prepare("
                    delete from usuario where id = ?
                ");

                $sql->execute([$id]);
                $sql1->execute([$id]);

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
