<?php

    session_start();

    $_SESSION['name'] = 'Daniel';

    // Depois de verificar login e senha reinicie o ID da sessão.
    session_destroy();

    
    session_start();

    session_regenerate_id();

    echo session_id();
    echo "<br>";
    echo $_SESSION['name'];
    
?>