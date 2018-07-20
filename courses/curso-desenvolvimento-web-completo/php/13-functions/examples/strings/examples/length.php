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

  if( isset($_POST['value']) && !empty($_POST['value']) ){
    echo strlen($_POST['value']) . ' Caracteres';
  }

?>
