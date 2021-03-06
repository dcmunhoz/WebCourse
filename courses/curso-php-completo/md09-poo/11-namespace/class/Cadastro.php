<?php

class Cadastro{

    private $nome;
    private $email;
    private $senha;

    public function getNome():string{
        return $this->nome;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function getSenha():string{
        return $this->senha;
    }

    public function setNome(string $value){
        $this->nome = $value;
    }

    public function setEmail(string $value){
        $this->email = $value;
    }

    public function setSenha(string $value){
        $this->senha = $value;
    }

    public function __toString(){
        return json_encode(array(
            "nome"=>$this->getNome(),
            "email"=>$this->getSenha(),
            "senha"=>$this->getSenha()
        ));
    }


}

?>