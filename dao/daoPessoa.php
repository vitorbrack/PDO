<?php

require_once 'C:/xampp/htdocs/PHPMatutinoPDO/bd/Conecta.php';
require_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Pessoa.php';

class daoPessoa {

    public function inserir(Pessoa $pessoa){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $nome = $pessoa->getNome();
            $dtNasc = $pessoa->getDtNasc();
            $login = $pessoa->getLogin();
            $senha = $pessoa->getSenha();
            $perfil = $pessoa->getPerfil();
            $email = $pessoa->getEmail();
            $cpf = $pessoa->getCpf();
            $fkendereco = $pessoa->getFkEndereco();
            try {
                $stmt = $conecta->prepare("insert into pessoa values "
                        . "(null,?,?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $dtNasc);
                $stmt->bindParam(3, $login);
                $stmt->bindParam(4, $senha);
                $stmt->bindParam(5,$perfil);
                $stmt->bindParam(6,$email);
                $stmt->bindParam(7,$cpf);
                $stmt->bindParam(8,$fkendereco);
                $stmt->execute();
                $msg->setMsg("<p style='color: green;'>"
                        . "Dados Cadastrados com sucesso</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>"
                        . "Erro na conexão com o banco de dados.</p>");
        }
        $conn = null;
        return $msg;
    }

}
