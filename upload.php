<?php

$currentDir = getcwd();
$uploadDirectory = "/bucket/";

$errors = []; // Store all foreseen and unforseen errors here

$fileName = $_FILES['file']['name'];
$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
$fileSize = $_FILES['file']['size'];
$fileTmpName  = $_FILES['file']['tmp_name'];
$fileType = $_FILES['file']['type'];
$magicStr = "loremIpsum";

$uploadPath = $currentDir . $uploadDirectory . md5(basename($fileName) . $magicStr . date('D, d M Y H:i:s')) . "." . $fileExt; 

if (isset($_POST['submit'])) {

    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}

