<?php
  // Laço For
  echo "Laço FOR <br><br>";
  for ( $i = 1; $i <= 10; $i++){
    echo "Repetição " . $i . "<br>";

  }
  echo "<br>";

  // Laço While
  echo "Laço While <br><br>";
  $j = 1;
  while ( $j <= 10 ){
    echo "Repetição ". $j . "<br>";
    $j++;
  }
  echo "<br>";

  // Laço Do While
  echo "Laço Do While <br><br>";
  $k = 1;
  do{
    echo "Repetição " . $k . "<br>";
    $k++;
  }while($k <= 10);

  echo "<br>";

  echo "Percorrer uma matriz com laços de repetição<br><br>";
  $matriz = [];
  for ($d = 0; $d < 10; $d++){
    for ($e = 0; $e < 10; $e++){
      if ($d == $e){
        $matriz[$d][$e] = 1;
      }else{
        $matriz[$d][$e] = 0;
      }
      echo $matriz[$d][$e];
    }
    echo "<br>";
  }

  echo "<br>";

  echo "Percorrer uma matriz com foreach<br><br>";
  $produto[0] = "Mesa";
  $produto[1] = "Sofá";
  $produto[2] = "Cama";
  $produto[3] = "Geladeira";
  $produto[4] = "TV";

  foreach ($produto as $prod){
    echo $prod . "<br>";
  }


 ?>
