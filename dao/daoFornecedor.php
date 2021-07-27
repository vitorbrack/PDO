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
            $numero = $fornecedor->getNumero();
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
                        . "(null,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $nomeFornecedor);
                $stmt->bindParam(2, $logradoro);
                $stmt->bindParam(3, $numero);
                $stmt->bindParam(5, $complemento);
                $stmt->bindParam(6, $bairro);
                $stmt->bindParam(7, $cidade);
                $stmt->bindParam(8, $UF);
                $stmt->bindParam(9, $cep);
                $stmt->bindParam(10, $representante);
                $stmt->bindParam(11, $email);
                $stmt->bindParam(12, $telfixo);
                $stmt->bindParam(13, $telcell);
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
            $numero = $fornecedor->getNumero();
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
                        . "numero = ?, "
                        . "complemento = ? "
                        . "barro = ? "
                        . "cidade = ? "
                        . "UF = ? "
                        . "cep = ? "
                        . "representante = ? "
                        . "email = ? "
                        . "telfixo = ? "
                        . "telcell = ? "
                        . "where idFornecedor = ?");
                        $stmt->bindParam(1, $nomeFornecedor);
                        $stmt->bindParam(2, $logradoro);
                        $stmt->bindParam(3, $numero);
                        $stmt->bindParam(5, $complemento);
                        $stmt->bindParam(6, $bairro);
                        $stmt->bindParam(7, $cidade);
                        $stmt->bindParam(8, $UF);
                        $stmt->bindParam(9, $cep);
                        $stmt->bindParam(10, $representante);
                        $stmt->bindParam(11, $email);
                        $stmt->bindParam(12, $telfixo);
                        $stmt->bindParam(13, $telcell);
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
    public function listarProdutosDAO(){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        if($conecta){
            try {
                $rs = $conecta->query("select * from produto");
                $lista = array();
                $a = 0;
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $produto = new Produto();
                            $produto->setIdProduto($linha->id);
                            $produto->setNomeProduto($linha->nome);
                            $produto->setVlrCompra($linha->vlrCompra);
                            $produto->setVlrVenda($linha->vlrVenda);
                            $produto->setQtdEstoque($linha->qtdEstoque);
                            $lista[$a] = $produto;
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
    public function excluirProdutoDAO($id){
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $msg = new Mensagem();
        if($conecta){
             try {
                $stmt = $conecta->prepare("delete from produto "
                        . "where id = ?");
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
    public function pesquisarProdutoIdDAO($id){
        $conn = new Conecta();
        $msg = new Mensagem();
        $conecta = $conn->conectadb();
        $produto = new Produto();
        if($conecta){
            try {
                $rs = $conecta->prepare("select * from produto where "
                        . "id = ?");
                $rs->bindParam(1, $id);
                if($rs->execute()){
                    if($rs->rowCount() > 0){
                        while($linha = $rs->fetch(PDO::FETCH_OBJ)){
                            $produto->setIdProduto($linha->id);
                            $produto->setNomeProduto($linha->nome);
                            $produto->setVlrCompra($linha->vlrCompra);
                            $produto->setVlrVenda($linha->vlrVenda);
                            $produto->setQtdEstoque($linha->qtdEstoque);
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
			 URL='../PHPMatutino01/cadastroProduto.php'\">"; 
        }
        return $produto;
    }
}
