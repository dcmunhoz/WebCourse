<?php

    // $data = [
    //     "nome"=>"daniel"
    // ];

    // define('SECRET', pack('a16', 'senha'));

    // $mcrypt = mcrypt_encrypt(
    //     MCRYPT_RIJNDAEL_128,
    //     SECRET,
    //     json_encode($data),
    //     MCRYPT_MODE_ECB
    // );

    // $final = base64_encode($mcrypt);

    // $string = mcrypt_decrypt(
    //     MCRYPT_RIJNDAEL_128,
    //     SECRET,
    //     base64_decode($final),
    //     MCRYPT_MODE_ECB
    // );

    // echo $string;

    define("SECRET_IV", pack("a16", 'senha'));
    define("SECRET", pack("a16", 'senha'));

    $data = [
        "nome"=>"Daniel"
    ];

    $openssl = openssl_encrypt(
        json_encode($data),
        'AES-128-CBC',
        SECRET,
        0,
        SECRET_IV
    );

    echo $openssl;

    $string = openssl_decrypt($openssl, 'AES-128-CBC', SECRET, 0 ,SECRET_IV);

    var_dump(json_decode($openssl, true));

?>