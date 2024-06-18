<?php

function fileUpload($image)
{

    if ($image["error"] == 4) {
        $imageName = "test_pic.jpg";
        $message = "No picture has been chosen, but you can upload one later";
    } else {
        $checkIfImage = getimagesize($image["tmp_name"]);
        $message = $checkIfImage ? "Success" : "Not an image";
    }
    if ($message == "Success") {
        $ext = strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
        $imageName = uniqid("") . "." . $ext;
        $destination = "pictures/{$imageName}";
        move_uploaded_file($image["tmp_name"], $destination);
    }

    return [$imageName, $message];
}
