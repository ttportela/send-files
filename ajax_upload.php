<?php
include_once 'func.php'; 
include_once 'classes.php';

$arr_file_types = ['text/plain', 'application/octet-stream'];

//echo print_r($_FILES); die;

if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "   <li class=\"mdl-list__item\">
    <span class=\"mdl-list__item-primary-content\">Tipo de arquivo inválido.</span>
    <span class=\"mdl-list__item-secondary-content\">".$_FILES["file"]["type"]."</span>
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