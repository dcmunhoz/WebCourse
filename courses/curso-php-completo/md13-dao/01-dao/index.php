<?php

require_once("config.php");

$sql = new Sql();

$res = $sql->select("SELECT * FROM tb_usuarios");

foreach($res as $row){
    $ar = array();

    foreach($row as $key => $value){
        $ar[$key] = $value;
        
    }
    echo json_encode($ar);
    echo "<br>";

}

?>