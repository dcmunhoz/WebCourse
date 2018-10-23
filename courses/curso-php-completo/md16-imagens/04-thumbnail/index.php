<?php

    header("Content-type: image/jpeg");

    $file = "wallpaper.jpg";

    $newWidth  = 256;
    $newHeight = 256;

    $data = getimagesize($file);

    list($oldWidth, $oldHeight) = getimagesize($file);


    $new_image = imagecreatetruecolor($newWidth, $newHeight);
    $old_image = imagecreatefromjpeg($file);

    imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

    imagejpeg($new_image);

    imagedestroy($old_image);   
    imagedestroy($new_image);

?>