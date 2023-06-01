<?php
$arr_file_types = ['text/plain', 'text/java', 'text/py'];

//echo print_r($_FILES); die;

if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "error mime: ". $_FILES['file']['type'];
    die;
}
 
/**
if (!file_exists('uploads')) {
    mkdir('uploads', 0777);
} */
 
$filename = time().'_'.$_FILES['file']['name'];
 
/**
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$filename);
*/
echo 'Arquivo: '.$filename;
die;
?>