<?php
  include("chita.php");
  include("gato.php");

  $chita = new Chita();
  $gato  = new Gato();

  $chita->correr();
  echo '<br>';
  $gato->correr();

?>
