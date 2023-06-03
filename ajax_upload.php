<?php
include_once 'func.php'; 
include_once 'classes.php';

$arr_file_types = ['text/plain', 'application/octet-stream'];
$arr_ext = ['txt', 'java', 'html', 'py'];

//echo print_r($_FILES); die;
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

$temp = new FileHolder();
if (!(in_array($_FILES['file']['type'], $arr_file_types)) && !(in_array($ext, $arr_ext))) {
    $temp->name = $_FILES['file']['name'];
    $temp->size = 'Tipo de arquivo inválido.';
    $temp->mime = null;
} else {
    $temp->name = $_FILES['file']['name'];
    $temp->content = file_get_contents($_FILES["file"]["tmp_name"]);
    $temp->mime = $_FILES["file"]["type"];
    $temp->size = $_FILES["file"]["size"];

    add_file($temp); // Only adds if valid file
}

echo $temp->toLiHTML();
die;
?>