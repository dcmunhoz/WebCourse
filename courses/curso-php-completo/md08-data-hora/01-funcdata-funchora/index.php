<?PHP

    echo date("d/m/Y H:i:s");

    echo "<br>";

    echo time();

    
    echo "<br>";
    echo "<br>";

    $ts =  strtotime('2001-09-11');
    echo date("l, d/m/Y", $ts);


?>