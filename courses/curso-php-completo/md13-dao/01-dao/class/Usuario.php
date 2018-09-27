<?php

class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;


    public function getIdUsuario(){
        return $this->idusuario;
    }

    public function setIdUsuario($value){
        $this->idusuario = $value;
    }

    public function getLogin(){
        return $this->deslogin;
    }

    public function setLogin($value){
        $this->deslogin = $value;
    }

    public function getSenha(){
        return $this->dessenha;
    }

    public function setSenha($value){
        $this->dessenha = $value;
    }

    public function getDtCadastro(){
        return $this->dtcadastro;
    }

    public function setDtCadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID;", array(":ID"=>$id));

        if(count($result) > 0){
            
            $row = $result[0];

            $this->setIdUsuario($row['idusuario']);
            $this->setLogin($row['deslogin']);
            $this->setSenha($row['dessenha']);
            $this->setDtCadastro(new DateTime($row['dtcadastro']));

        }

    }

    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdUsuario(),
            "deslogin"=>$this->getLogin(),
            "dessenha"=>$this->getSenha(),
            "dtcadastro"=>$this->getDtCadastro()->format('d/m/Y'),
        ));

    }

}


?>