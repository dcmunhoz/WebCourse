<form action="" method="GET">
    <input type="text" id="nome" name="nome" placeholder="Nome Completo">
    <br>
    <input type="date" id="nascimento" name="nascimento">
    <br>
    <br>
    <button type="submit">Enviar</button>

</form>



<?php 

    if(isset($_GET)){
        foreach($_GET as $indexName => $fieldValue){
            echo "Field: $indexName </br>";
            echo "Value: $fieldValue";
            echo "<hr>";
        }
    }

    // $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junhos", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

    // foreach($meses as $index => $mes){
    //     echo "$index - O mes é $mes </br>";
    // }


?>