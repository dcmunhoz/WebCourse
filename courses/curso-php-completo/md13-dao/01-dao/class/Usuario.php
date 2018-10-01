<?php

class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function __construct($login = "", $senha = ""){
        $this->setLogin($login);
        $this->setSenha($senha);
    }

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
            
            $this->setData($result[0]);

        }

    }

    public static function getList(){

        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin;", array(':SEARCH'=>"%".$login."%"));
    }

    public function login($login, $senha){

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA;", array(":LOGIN"=>$login, ":SENHA"=>$senha));
        
        if(count($result) > 0){
            
            $this->setData($result[0]);

        }else{

            throw new Exception("Login e/ou senha inválidos.");

        }

    }

    public function setData($dados){
        $this->setIdUsuario($dados['idusuario']);
        $this->setLogin($dados['deslogin']);
        $this->setSenha($dados['dessenha']);
        $this->setDtCadastro(new DateTime($dados['dtcadastro']));
    }

    public function insert(){
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA);", array(
            ":LOGIN"=>$this->getLogin(), 
            ":SENHA"=>$this->getSenha()
        ));
        
        if(count($results)>0){
            $this->setData($results[0]);
        }

    }

    public function update($login, $senha){

        $this->setLogin($login);
        $this->setSenha($senha);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID;", array(
            ":LOGIN"=>$this->getLogin(),
            ":SENHA"=>$this->getSenha(),
            ":ID"=>$this->getIdUsuario()
        ));
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