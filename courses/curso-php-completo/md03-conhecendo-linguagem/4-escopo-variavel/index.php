<?php

$grito = "SHAZAM!";

function casa1(){
    
    global $grito;
    
    echo $grito;
}

echo "<br>";
echo "<br>";

function casa2(){

    echo $grito;

}

casa1();
casa2();