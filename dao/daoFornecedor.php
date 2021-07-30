<?php
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/bd/Conecta.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Produto.php';
include_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Mensagem.php';

class DaoFornecedor {

    public function inserir(Fornecedor $fornecedor){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $nomeFornecedor = $fornecedor->getNomeFornecedor();
            $logradoro = $fornecedor->getLogradoro();
          
            $complemento = $fornecedor->getComplemento();
            $bairro = $fornecedor->getBairro();
            $cidade = $fornecedor->getCidade();
            $UF = $fornecedor->getUF();
            $cep = $fornecedor->getCep();
            $representante = $fornecedor->getRepresentante();
            $email = $fornecedor->getEmail();
            $telfixo = $fornecedor->getTelfixo();
            $telcell = $fornecedor->getTelcell();
            try {
                $stmt = $conecta->prepare("insert into fornecedor values "
                        . "(null,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $nomeFornecedor);
                $stmt->bindParam(2, $logradoro);
                $stmt->bindParam(3, $complemento);
                $stmt->bindParam(4, $bairro);
                $stmt->bindParam(5, $cidade);
                $stmt->bindParam(6, $UF);
                $stmt->bindParam(7, $cep);
                $stmt->bindParam(8, $representante);
                $stmt->bindParam(9, $email);
                $stmt->bindParam(10, $telfixo);
                $stmt->bindParam(11, $telcell);
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
    
    //método para atualizar dados da tabela produto
    public function atualizarFornecedorDAO(Fornecedor $fornecedor){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            $idFornecedor = $fornecedor->getIdFornecedor();
            $nomeFornecedor = $fornecedor->getNomeFornecedor();
            $logradoro = $fornecedor->getLogradoro();
            $complemento = $fornecedor->getComplemento();
            $bairro = $fornecedor->getBairro();
            $cidade = $fornecedor->getCidade();
            $UF = $fornecedor->getUF();
            $cep = $fornecedor->getCep();
            $representante = $fornecedor->getRepresentante();
            $email = $fornecedor->getEmail();
            $telfixo = $fornecedor->getTelfixo();
            $telcell = $fornecedor->getTelcell();
            try{
                $stmt = $conecta->prepare("update fornecedor set "
                        . "nomeForncedor = ?,"
                        . "logradoro = ?,"
                        . "complemento = ?, "
                        . "bairro = ?, "
                        . "cidade = ? ,"
                        . "UF = ? ,"
                        . "cep = ? ,"
                        . "representante = ?, "
                        . "email = ? ,"
                        . "telfixo = ?, "
                        . "telcell = ? "
                        . "where idFornecedor = ?");
                        $stmt->bindParam(1, $nomeFornecedor);
                        $stmt->bindParam(2, $logradoro);
                        $stmt->bindParam(3, $complemento);
                        $stmt->bindParam(4, $bairro);
                        $stmt->bindParam(5, $cidade);
                        $stmt->bindParam(6, $UF);
                        $stmt->bindParam(7, $cep);
                        $stmt->bindParam(8, $representante);
                        $stmt->bindParam(9, $email);
                        $stmt->bindParam(10, $telfixo);
                        $stmt->bindParam(11, $telcell);
                        $stmt->bindParam(12, $idFornecedor);
                $stmt->execute();
                $msg->setMsg("<p style='color: blue;'>"
                        . "Dados atualizados com sucesso</p>");
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
    
     //método para carregar lista de produtos do banco de dados
     public function listarFornecedorsDAO(){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            try {
                $rs = $conecta->query("select * from fornecedor");
                $lista = array();
                $a = 0;
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $fornecedor = new Fornecedor();
                            $fornecedor->setIdFornecedor($linha->idFornecedor);
                            $fornecedor->setNomeFornecedor($linha->nomeFornecedor);
                            $fornecedor->setLogradoro($linha->logradoro);
                            $fornecedor->setComplemento($linha->complemento);
                            $fornecedor->setBairro($linha->bairro);
                            $fornecedor->setCidade($linha->cidade);
                            $fornecedor->setUF($linha->UF);
                            $fornecedor->setCep($linha->cep);
                            $fornecedor->setRepresentante($linha->representante);
                            $fornecedor->setEmail($linha->email);
                            $fornecedor->setTelFixo($linha->telfixo);
                            $fornecedor->setTelcell($linha->telcell);
                            $lista[$a] = $fornecedor;
                            $a++;
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;           
            return $lista;
        }
    }
    
    //método para excluir produto na tabela produto
    public function excluirFornecedorDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
             try {
                $stmt = $conecta->prepare("delete from fornecedor "
                        . "where idfornecedor = ?");
                $stmt->bindParam(1, $id);
                $stmt->execute();
                $msg->setMsg("<p style='color: #d6bc71;'>"
                        . "Dados excluídos com sucesso.</p>");
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }
        }else{
            $msg->setMsg("<p style='color: red;'>'Banco inoperante!'</p>"); 
        }
        $conn = null;
        return $msg;
    }
    
    //método para os dados de produto por id
    public function pesquisarFornecedorIdDAO($id){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        $fornecedor = new Fornecedor();
        if($conecta){
            try {
                $rs = $conecta->prepare("select * from fornecedor where "
                        . "idfornecedor = ?");
                $rs->bindParam(1, $id);
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $fornecedor->setIdFornecedor($linha->idFornecedor);
                            $fornecedor->setNomeFornecedor($linha->nomeFornecedor);
                            $fornecedor->setLogradoro($linha->logradoro);   
                            $fornecedor->setComplemento($linha->complemento);
                            $fornecedor->setbairro($linha->bairro);
                            $fornecedor->setCidade($linha->cidade);
                            $fornecedor->setUF($linha->UF);
                            $fornecedor->setCep($linha->cep);
                            $fornecedor->setRepresentante($linha->representante);
                            $fornecedor->setEmail($linha->email);
                            $fornecedor->setTelFixo($linha->telfixo);
                            $fornecedor->setTelcell($linha->telcell);
                        }
                    }
                }
            } catch (Exception $ex) {
                $msg->setMsg($ex);
            }  
            $conn = null;
        }else{
            echo "<script>alert('Banco inoperante!')</script>";
            echo "<META HTTP-EQUIV='REFRESH' CONTENT=\"0;
			 URL='../PHPMatutinoPDO/cadastroFornecedor.php'\">"; 
        }
        return $fornecedor;
    }
}
