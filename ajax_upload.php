<?php
include_once 'func.php'; 
include_once 'classes.php';

$arr_file_types = ['text/plain', 'application/octet-stream'];
$arr_ext = ['txt', 'java', 'html', 'py'];

//echo print_r($_FILES); die;
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

if (!(in_array($_FILES['file']['type'], $arr_file_types)) && !(in_array($ext, $arr_ext))) {
    echo "   <li class=\"mdl-list__item\">
    <span class=\"mdl-list__item-primary-content\">Tipo de arquivo inválido.</span>
    <span class=\"mdl-list__item-secondary-content\">".$_FILES['file']['name'].": ".$_FILES["file"]["type"]."</span>
</li>";
    die;
}

$temp = new FileHolder();
$temp->name = $_FILES['file']['name'];
$temp->content = file_get_contents($_FILES["file"]["tmp_name"]);

add_file($temp);

echo "   <li class=\"mdl-list__item\">
        <span class=\"mdl-list__item-primary-content\">".$temp->name."</span>
        <span class=\"mdl-list__item-secondary-content\">".$_FILES["file"]["type"]."</span>
    </li>";
die;
?>