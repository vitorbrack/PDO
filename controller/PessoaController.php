<?php
require_once "C:/xampp/htdocs/PHPMatutinoPDO/dao/daoPessoa.php";
require_once 'C:/xampp/htdocs/PHPMatutinoPDO/model/Pessoa.php';
require_once 'c:/xampp/htdocs/PHPMatutinoPDO/model/Endereco.php';
require_once 'c:/xampp/htdocs/PHPMatutinoPDO/model/Mensagem.php';

class PessoaController {

    public function inserirPessoa($nome, $dtNasc, $login, $senha, 
            $perfil, $email, $cpf, $cep, $logradouro , $uf , $bairro, $cidade, $complemento){

        $endereco = new Endereco();
        $endereco->setCep($cep);
        $endereco->setLogradouro($logradouro);
        $endereco->setUf($uf);
        $endereco->setBairro($bairro);
        $endereco->setCidade($cidade);
        $endereco->setComplemento($complemento);
                
        $pessoa = new Pessoa();
        $pessoa->setNome($nome);
        $pessoa->setDtNasc($dtNasc);
        $pessoa->setLogin($login);
        $pessoa->setSenha($senha);
        $pessoa->setPerfil($perfil);
        $pessoa->setEmail($email);
        $pessoa->setCpf($cpf);
        
        $pessoa->setFkEndereco($endereco);

     
        $daoPessoa = new daoPessoa();
        return $daoPessoa->inserir($pessoa);
    }
    public function atualizarPessoa(
        $id,
        $nome,
        $dtNasc,
        $login,
        $senha,
        $perfil,
        $email,
        $cpf,
        $cep,
        $logradouro,
        $complemento,
        $bairro,
        $cidade,
        $uf
    ) {
        $endereco = new Endereco();
        $endereco->setCep($cep);
        $endereco->setLogradouro($logradouro);
        $endereco->setComplemento($complemento);
        $endereco->setBairro($bairro);
        $endereco->setCidade($cidade);
        $endereco->setUf($uf);
        $pessoa = new Pessoa();

        $pessoa->setIdPessoa($id);
        $pessoa->setNome($nome);
        $pessoa->setDtNasc($dtNasc);
        $pessoa->setLogin($login);
        $pessoa->setSenha($senha);
        $pessoa->setPerfil($perfil);
        $pessoa->setEmail($email);
        $pessoa->setCpf($cpf);

        $pessoa->setFkEndereco($endereco);

        $daoPessoa = new daoPessoa();
        return $daoPessoa->atualizarPessoaDAO($pessoa);
    }

    public function listarPessoas()
    {
        $daoPessoa = new daoPessoa();
        return $daoPessoa->listarPessoasDAO();
    }
    public function excluirPessoaDAO($id){
        $daoPessoa = new DaoPessoa();
        return $daoPessoa->excluirPessoaDAO($id);
    }

    public function pesquisarPessoaIdDAO($id){
        $daoPessoa = new daoPessoa();
        return $daoPessoa->pesquisarPessoaIdDAO($id);
    }
}


