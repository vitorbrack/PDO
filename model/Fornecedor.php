<?php

class Fornecedor{

    private $idFornecedor;
    private $nomeFornecedor;
    private $logradoro;
    private $complemento;
    private $bairro;
    private $cidade;
    private $UF;
    private $cep;
    private $representante;
    private $email;
    private $telfixo;
    private $telcell; 

    /**
     * Get the value of idFornecedor
     */ 
    public function getIdFornecedor()
    {
        return $this->idFornecedor;
    }

    /**
     * Set the value of idFornecedor
     *
     * @return  self
     */ 
    public function setIdFornecedor($idFornecedor)
    {
        $this->idFornecedor = $idFornecedor;

        return $this;
    }

    /**
     * Get the value of nomeFornecedor
     */ 
    public function getNomeFornecedor()
    {
        return $this->nomeFornecedor;
    }

    /**
     * Set the value of nomeFornecedor
     *
     * @return  self
     */ 
    public function setNomeFornecedor($nomeFornecedor)
    {
        $this->nomeFornecedor = $nomeFornecedor;

        return $this;
    }

    /**
     * Get the value of logradoro
     */ 
    public function getLogradoro()
    {
        return $this->logradoro;
    }

    /**
     * Set the value of logradoro
     *
     * @return  self
     */ 
    public function setLogradoro($logradoro)
    {
        $this->logradoro = $logradoro;

        return $this;
    }
    /**
     * Get the value of complemento
     */ 
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set the value of complemento
     *
     * @return  self
     */ 
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get the value of bairro
     */ 
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */ 
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of cidade
     */ 
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set the value of cidade
     *
     * @return  self
     */ 
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    /**
     * Get the value of UF
     */ 
    public function getUF()
    {
        return $this->UF;
    }

    /**
     * Set the value of UF
     *
     * @return  self
     */ 
    public function setUF($UF)
    {
        $this->UF = $UF;

        return $this;
    }

    /**
     * Get the value of cep
     */ 
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set the value of cep
     *
     * @return  self
     */ 
    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    /**
     * Get the value of representante
     */ 
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Set the value of representante
     *
     * @return  self
     */ 
    public function setRepresentante($representante)
    {
        $this->representante = $representante;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telfixo
     */ 
    public function getTelfixo()
    {
        return $this->telfixo;
    }

    /**
     * Set the value of telfixo
     *
     * @return  self
     */ 
    public function setTelfixo($telfixo)
    {
        $this->telfixo = $telfixo;

        return $this;
    }

    /**
     * Get the value of telcell
     */ 
    public function getTelcell()
    {
        return $this->telcell;
    }

    /**
     * Set the value of telcell
     *
     * @return  self
     */ 
    public function setTelcell($telcell)
    {
        $this->telcell = $telcell;

        return $this;
    }
}