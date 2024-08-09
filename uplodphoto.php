<?php
session_start();

function upload($file)
{
    $filename = $file['name'];
    $tempname = $file['tmp_name'];
    $fileerror = $file['error'];
    $imatype = pathinfo($filename, PATHINFO_EXTENSION);


    if ($fileerror != 0) {
        echo 'Error code: ' . $fileerror;
        return false;
    } else if ($imatype == "jpg" || $imatype == "jpeg" || $imatype == "png" || $imatype == "gif" || $imatype == "bmp" || $imatype == "svg" || $imatype == "tiff" || $imatype == "webp" || $imatype == "avif") {
        $imagepath = 'image/' . uniqid("IMG-", true) . '.' . $imatype;
        if (move_uploaded_file($tempname, $imagepath)) {
            return $imagepath;
        } else {
  
            $_SESSION['error'] = 'File upload failed. Ensure the "file" directory exists and is writable.';
        }
    } else {
   
        $_SESSION['error'] = 'Invalid file type. Only JPG, PNG, and SVG files are allowed.';
    }

    return false;
}
?>