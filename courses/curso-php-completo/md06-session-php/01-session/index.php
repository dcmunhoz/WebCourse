<?php

    session_start();
    $_SESSION["nome"] = 'Daniel';


    session_unset();
    echo $_SESSION['nome'];


?>