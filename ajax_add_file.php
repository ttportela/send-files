<?php
include_once 'func.php'; 
include_once 'classes.php';

$temp = new FileHolder();
if (isset($_POST['file_name']) && isset($_POST['file_content'])) {
    $temp->name = $_POST['file_name'];
    $temp->content = $_POST['file_content'];
    $temp->mime = 'text/plain';
    $temp->size = strlen($temp->content);

    add_file($temp); // Only adds if valid file
} else {
    $temp->name = 'Erro!';
    $temp->size = 'Preencha todos os campos.';
}

echo $temp->toLiHTML();
die;
?>