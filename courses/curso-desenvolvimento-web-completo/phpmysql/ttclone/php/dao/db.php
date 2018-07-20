<?php

  // Classe de conexão com MySql
  class dataBase{

    //Host
    private $host = 'localhost';

    //Porta
    private $porta = '3306';

    //Usuario
    private $usuario = 'root';

    //Senha
    private $senha = '';

    //Banco de dados
    private $db = 'twitter_clone';

    public function conectaDB(){
      //criar a conexão
      $conn = mysqli_connect($this->host, $this->usuario, $this->senha, $this->db);
      // Ajustar charset de comunicação
      mysqli_set_charset($conn, 'utf8');

      // Verificar se houve erros de conexão
      if(mysqli_connect_errno()){
        echo 'Erro ao tentar se conectar com o banco de dados: ' . mysqli_connect_error();
      }

      return $conn;
    }

  }

?>
