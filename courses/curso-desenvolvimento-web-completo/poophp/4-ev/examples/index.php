<?php

  include("veiculo.php");


  $carro = new Veiculo();

  $carro->setPlaca("DCM2121");

  echo $carro->getPlaca();

?>
