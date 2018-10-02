<?php

    // $name = "images";

    // if(!is_dir($name)){

    //     mkdir($name);
    //     echo "Diretorio criado com sucesso";

    // }else{
    //     rmdir($name);
    //     echo "Diretorio removido";
    // }

    $images = scandir("images");
    $data = array();
    foreach ($images as $img) {
        if(!in_array($img, array(".", ".."))){
            $filename = "images" . DIRECTORY_SEPARATOR . $img;

            $info = pathinfo($filename);
            $info["size"] = filesize($filename);
            $info["modified"] = date("d/m/Y H:i:s", filemtime($filename));
            $info["url"] = "http://localhost:8133/WebCourse/courses/curso-php-completo/md14-manipular-arquivos/01-rm-file/" . str_replace("\\", "/", $filename);


            array_push($data, $info);

        }
    }

    echo json_encode($data);

?>