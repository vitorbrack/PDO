<?php

require_once 'C:/xampp/htdocs/PHPMatutinoPDO/bd/Conecta.php';
require_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Pessoa.php';
require_once  'C:/xampp/htdocs/PHPMatutinoPDO/model/Endereco.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Mensagem.php.php';

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
            
            $logradouro = $pessoa->getEndereco()->getLogradouro();
            $complemento = $pessoa->getEndereco()->getComplemento();
            $bairro = $pessoa->getEndereco()->getBairro();
            $cidade = $pessoa->getEndereco()->getCidade();
            $uf = $pessoa->getEndereco()->getUf();
            $cep = $pessoa->getEndereco()->getCep();

           
            //$msg->setMsg("$logradouro, $complemento, $cep");
            try {
                //processo para pegar o idendereco da tabela endereco, conforme 
                //o cep, o logradouro e o complemento informado.
                $st = $conecta->prepare("select idendereco "
                        . "from endereco where cep = ? and "
                        . "logradouro = ? and complemento = ? limit 1");
                $st->bindParam(1, $cep);
                $st->bindParam(2, $logradouro);
                $st->bindParam(3, $complemento);
                if($st->execute()){
                    if($st->rowCount() > 0){
                        $msg->setMsg("".$st->rowCount());
                        while($linha = $st->fetch(PDO::FETCH_OBJ)){
                            $fkEnd = $linha->idendereco;
                        }
                        //$msg->setMsg("$fkEnd");
                    }else{
                        $st2 = $conecta->prepare("insert into "
                                . "endereco values (null,?,?,?,?,?,?)");
                        $st2->bindParam(1, $logradouro);
                        $st2->bindParam(2, $complemento);
                        $st2->bindParam(3, $bairro);
                        $st2->bindParam(4, $cidade);
                        $st2->bindParam(5, $uf);
                        $st2->bindParam(6, $cep);
                        $st2->execute();

                        $st3 = $conecta->prepare("select idendereco "
                            . "from endereco where cep = ? and "
                            . "logradouro = ? and complemento = ? limit 1");
                        $st3->bindParam(1, $cep);
                        $st3->bindParam(2, $logradouro);
                        $st3->bindParam(3, $complemento);
                        if($st3->execute()){
                            if($st3->rowCount() > 0){
                                $msg->setMsg("".$st3->rowCount());
                                while($linha = $st3->fetch(PDO::FETCH_OBJ)){
                                    $fkEnd = $linha->idendereco;
                                }
                                //$msg->setMsg("$fkEnd");
                            }
                        }
                    }
                    
                    //processo para inserir dados de fornecedor
                    $stmt = $conecta->prepare("insert into fornecedor values "
                            . "(null,?,?,?,?,?,?)");
                    $stmt->bindParam(1, $nomeFornecedor);
                    $stmt->bindParam(2, $representante);
                    $stmt->bindParam(3, $email);
                    $stmt->bindParam(4, $telFixo);
                    $stmt->bindParam(5, $telCel);
                    $stmt->bindParam(6, $fkEnd);
                    $stmt->execute();
                }
                
                //$msg->setMsg("<p style='color: green;'>"
                        //. "Dados Cadastrados com sucesso</p>");
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