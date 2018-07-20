<form action="" method="post">
  <label for="value">String:</label><br>
  <input type="text" name="value" id="value"><br>
  <br>
  <button type="submit" name="button">Enviar</button>
</form>
<br>
Modificação:
<br>

<?php
  $valor = isset($_POST['value']) ? $_POST['value'] : '';
  $tamanho = strlen($valor);

  if($tamanho > 0 && !empty($valor)){
    for($i = 0; $i < $tamanho; $i++){
      echo substr($valor,$i,1) . ' Posição: ' . $i . '<br>';
    }
  }

?>
