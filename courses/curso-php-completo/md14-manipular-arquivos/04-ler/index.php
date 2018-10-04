<?php

    // $fileName = "usuarios.csv";

    // if(file_exists($fileName)){

    //     $file = fopen($fileName, "r");

    //     $headers = explode(";", fgets($file));

    //     $data = array();

    //     while($row = fgets($file)){

    //         $rowData = explode(";", $row);
    //         $linha = array();


    //         for($i = 0; $i < count($headers); $i++){

    //             $linha[$headers[$i]] = $rowData[$i];

    //         }

    //         array_push($data, $linha);

    //     }

    //     fclose($file);
    
    //     echo json_encode($data);
    
    // }

    $fileName = "logo.png";
    $base64 = base64_encode(file_get_contents($fileName));

    $fileinfo = new finfo(FILEINFO_MIME_TYPE);
    
    $mimetype = $fileinfo->file($fileName);

    $base64encode =  "data:". $mimetype .";base64," . $base64;


?>

<a href="<?php echo $base64encode?>" >Link para imagem</a>